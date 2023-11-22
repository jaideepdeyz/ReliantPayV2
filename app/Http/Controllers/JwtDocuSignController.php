<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Models\AuthorizationForm;
use App\Models\SaleBooking;
use DocuSign\eSign\Api\EnvelopesApi;
use DocuSign\eSign\Client\ApiClient;
use DocuSign\eSign\Model\CompositeTemplate;
use DocuSign\eSign\Model\Document;
use DocuSign\eSign\Model\EnvelopeDefinition;
use DocuSign\eSign\Model\InlineTemplate;
use DocuSign\eSign\Model\Recipients;
use DocuSign\eSign\Model\Signer;
use DocuSign\eSign\Model\SignHere;
use DocuSign\eSign\Model\Tabs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PharIo\Manifest\Author;

class JwtDocuSignController extends Controller
{

    private $signer_client_id = 1000;
    /**
     * @param Request $request
     * 
     * @return object
     */
    public function authorizebooking($id): object
    {
        $apiClient = new ApiClient();
        $apiClient->getOAuth()->setOAuthBasePath(env('DS_AUTH_SERVER'));
        try {
            $accessToken = $this->getToken($apiClient);
        } catch (\Throwable $th) {
            if (strpos($th->getMessage(), 'consent_required') !== false) {
                $authorizationUrl = 'https://' . env('DS_AUTH_SERVER') . '/oauth/auth?' . http_build_query([
                    'scope' => 'signature impersonation',
                    'redirect_uri' => route('dashboard'),
                    'client_id' => env('DOCUSIGN_CLIENT_ID'),
                    'response_type' => 'code'

                ], '', '&', PHP_QUERY_RFC3986);

                return redirect($authorizationUrl);
            }

            return back()->withError($th->getMessage())->withInput();
        }
        /**
         * 
         * Step 3
         * Get user's info i.e. accounts array and base path
         * 
         * Update the base path. The result in demo will be https://demo.docusign.net/restapi
         * User default account is always first in the array
         * 
         */
        $userInfo = $apiClient->getUserInfo($accessToken);
        $accountInfo = $userInfo[0]->getAccounts();
        $apiClient->getConfig()->setHost($accountInfo[0]->getBaseUri() . env('DS_ESIGN_URI_SUFFIX'));
        /**
         * 
         * Step 4
         * Build the envelope object
         * 
         * Make an API call to create the envelope and display the response in the view
         * 
         */

        try {
            $pdf = Pdf::loadView('pdf.sample');
            $filePath = storage_path('app/public/pdf/sample.pdf');
            $pdf->save(storage_path('app/public/pdf/sample.pdf'));
            $envelopeDefenition = $this->buildEnvelope($id, $pdf);
            DB::beginTransaction();
            $envelopeApi = new EnvelopesApi($apiClient);
            $result = $envelopeApi->createEnvelope($accountInfo[0]->getAccountId(), $envelopeDefenition);
            $envelope_id = $result->getEnvelopeId();
            AuthorizationForm::create([
                'app_id' => $id,
                'envelope_id' => $envelope_id,
                'unsigned_document' => 'public/pdf/sample.pdf',
                'account_id' => $accountInfo[0]->getAccountId(),
                'document_id' => '1',
            ]);
            $sale = SaleBooking::find($id);
            $sale->app_status = StatusEnum::SENT_FOR_AUTH->value;
            $sale->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            return back()->withError($th->getMessage())->withInput();
        }
        return redirect()->route('dashboard')->withSuccess('Authorization form sent successfully');
    }

    /**
     * @param Request $request
     * 
     * @return EnvelopeDefinition
     */
    private function buildEnvelope($id, $pdf): EnvelopeDefinition
    {
        $saleBooking = SaleBooking::where('id', $id)->first();
        $recipientName = $saleBooking->customer_name;
        $recipientEmail = $saleBooking->customer_email;

        $document = new Document([
            'document_id' => '1',
            'document_base64' => base64_encode($pdf->output()),
            'file_extension' => "pdf",
            'name' => 'Authorization Form for ' . $saleBooking->customer_name
        ]);
        $sign_here_tab = new SignHere([
            'anchor_string' => "**signature**",
            'anchor_units' => "pixels",
            'anchor_x_offset' => "100",
            'anchor_y_offset' => "0"
        ]);
        $sign_here_tabs = [$sign_here_tab];
        $tabs1 = new Tabs([
            'sign_here_tabs' => $sign_here_tabs
        ]);
        $signer = new Signer([
            'email' => $recipientEmail,
            'name' =>  $recipientName,
            'recipient_id' => rand(),
            'tabs' => $tabs1
        ]);
        $signers = [$signer];
        $recipients = new Recipients([
            'signers' => $signers
        ]);
        $inline_template = new InlineTemplate([
            'recipients' => $recipients,
            'sequence' => "1"
        ]);
        $inline_templates = [$inline_template];
        $composite_template = new CompositeTemplate([
            'composite_template_id' => "1",
            'document' => $document,
            'inline_templates' => $inline_templates
        ]);
        $composite_templates = [$composite_template];
        $envelope_definition = new EnvelopeDefinition([
            'composite_templates' => $composite_templates,
            'email_subject' => "Please sign",
            'status' => "sent"
        ]);

        return $envelope_definition;
    }

    /**
     * @param ApiClient $apiClient
     * 
     * @return string
     */
    private function getToken(ApiClient $apiClient): string
    {
        try {
            $privateKey = file_get_contents(storage_path(env('DS_KEY_PATH')), true);
            $response = $apiClient->requestJWTUserToken(
                $ikey = env('DOCUSIGN_CLIENT_ID'),
                $userId = env('DS_IMPERSONATED_USER_ID'),
                $key = $privateKey,
                $scope = env('DS_JWT_SCOPE')
            );
            $token = $response[0];
            $accessToken = $token->getAccessToken();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            throw $th;
        }
        return $accessToken;
    }
    public function checkAuthorizationForm($appId)
    {
        $apiClient = new ApiClient();
        $apiClient->getOAuth()->setOAuthBasePath(env('DS_AUTH_SERVER'));
        try {
            $accessToken = $this->getToken($apiClient);
        } catch (\Throwable $th) {
            if (strpos($th->getMessage(), 'consent_required') !== false) {
                $authorizationUrl = 'https://' . env('DS_AUTH_SERVER') . '/oauth/auth?' . http_build_query([
                    'scope' => 'signature impersonation',
                    'redirect_uri' => route('dashboard'),
                    'client_id' => env('DOCUSIGN_CLIENT_ID'),
                    'response_type' => 'code'

                ], '', '&', PHP_QUERY_RFC3986);

                return redirect($authorizationUrl);
            }
            Log::info($th->getMessage());

            return back()->withError($th->getMessage())->withInput();
        }
        try {
            $userInfo = $apiClient->getUserInfo($accessToken);
            $accountInfo = $userInfo[0]->getAccounts();
            $apiClient->getConfig()->setHost($accountInfo[0]->getBaseUri() . env('DS_ESIGN_URI_SUFFIX'));
            $app = AuthorizationForm::where('app_id', $appId)->first();
            $envelopeApi = new EnvelopesApi($apiClient);
            $result = $envelopeApi->getEnvelope($app->account_id, $app->envelope_id);
            if ($result['status'] != 'completed') {
                return redirect()->back();
            }
            $temp_file = $envelopeApi->getDocument($app->account_id, $app->document_id, $app->envelope_id);
            $file_path = storage_path('app/public/pdf/' . $appId . '.pdf');
           
            file_put_contents($file_path, file_get_contents($temp_file->getPathname()));
            $app->signed_document = 'public/pdf/' . $appId . '.pdf';
            $app->save();
            $sale = SaleBooking::find($appId);
            $sale->app_status = StatusEnum::AUTHORIZED->value;
            $sale->save();
            return redirect()->back();
        } catch (\Exception $th) {
            Log::info($th->getMessage());
            return redirect()->back();
            // return redirect()->back()->withError($th->getMessage())->withInput();
        }
    }
}

<?php

namespace App\Http\Controllers;

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
use Illuminate\Support\Facades\Log;

class JwtDocuSignController extends Controller
{
    
    private $signer_client_id = 1000;
    public function index(Request $request)
    {
        if($request->has('state')){
            dd($request->all());
        }
        
        return view('docusign.create');
    }
  /**
     * @param Request $request
     * 
     * @return object
     */
    public function send(Request $request): object{
        /**
         * 
         * Step 1
         * Validate request
         * 
         */
        $validator = Validator::make($request->all(), [
            'formFile' => 'required|mimes:doc,docx,pdf|max:2048',
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|max:255'
        ]);        
        if ($validator->fails()) {
            return redirect('/contract')
            ->withErrors($validator)
            ->withInput();
        } 
        // dd(route('contract'));
        /** 
         * 
         * Step 2
         * Instantiate the eSign API client and set the OAuth path used by the JWT request
         * 
         * Generate a new JWT access token
         * 
         */ 
        $apiClient = new ApiClient();
        $apiClient->getOAuth()->setOAuthBasePath(env('DS_AUTH_SERVER')); 
        try{
            $accessToken = $this->getToken($apiClient);
        } catch (\Throwable $th) {
            if(strpos($th->getMessage(), 'consent_required') !== false){
                $authorizationUrl = 'https://'.env('DS_AUTH_SERVER') . '/oauth/auth?' . http_build_query([
                    'scope' => 'signature impersonation',
                    'redirect_uri' =>route('contract'),
                    'client_id' => env('DS_CLIENT_ID'),
                    'response_type' => 'code',
                    'state'=> 'a=123',

                ], '', '&', PHP_QUERY_RFC3986);
                // dd($authorizationUrl);
               return redirect($authorizationUrl);
                // dd($authorizationUrl);
                return back()->withError($th->getMessage())->withInput();
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
        $envelopeDefenition = $this->buildEnvelope($request);           
        try {            
            $envelopeApi = new EnvelopesApi($apiClient);
            $result = $envelopeApi->createEnvelope($accountInfo[0]->getAccountId(), $envelopeDefenition);
            $envelope_id = $result->getEnvelopeId();

            // $authentication_method = 'None';          
            // $recipient_view_request = new \DocuSign\eSign\Model\RecipientViewRequest([
            //     'authentication_method' => $authentication_method,
            //     'client_user_id' =>$this->signer_client_id,
            //     'recipient_id' => $envelopeDefenition->getCompositeTemplates()[0]->getInlineTemplates()[0]->getRecipients()->getSigners()[0]->getRecipientId(),
            //     'return_url' => route('contract'),
            //     'user_name' => $request->name,
            //     'email' => $request->email
            // ]);

            // $results = $envelopeApi->createRecipientView(env('DOCUSIGN_ACCOUNT_ID'), $envelope_id, $recipient_view_request);
            // return redirect()->to($results['url']);
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage())->withInput();
        }      
        return view('docusign.response')->with('result', $result);
    }

    /**
     * @param Request $request
     * 
     * @return EnvelopeDefinition
     */
    private function buildEnvelope(Request $request): EnvelopeDefinition{

        $fileContent = $request->file('formFile')->get();
        $fileName = $request->file('formFile')->getClientOriginalName();
        $fileExtension = $request->file('formFile')->getClientOriginalExtension();
        $recipientEmail = $request['email'];
        $recipientName = $request['name'];            
        // $pdf = Pdf::loadView('pdf.sample');


        // $base64_file_content = base64_encode($pdf->output());
        $document = new Document([
            'document_id' => "1",
            'document_base64' => base64_encode($fileContent),
            'file_extension' => $fileExtension,  
            'name' => $fileName 
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
    private function getToken(ApiClient $apiClient) : string{
        try {
            $privateKey = file_get_contents(storage_path(env('DS_KEY_PATH')),true);
            $response = $apiClient->requestJWTUserToken(
                $ikey = env('DS_CLIENT_ID'),
                $userId = env('DS_IMPERSONATED_USER_ID'),
                $key = $privateKey,
                $scope = env('DS_JWT_SCOPE')
            );        
            $token = $response[0];
            $accessToken = $token->getAccessToken();
            Log::info('Access Token: ' . $accessToken);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            throw $th;
        }    
        return $accessToken;        
    }
   
}

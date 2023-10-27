<?php

namespace App\Http\Controllers;

use App\Models\AuthorizationForm;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use DocuSign\eSign\Configuration;
use DocuSign\eSign\Api\EnvelopesApi;
use DocuSign\eSign\Client\ApiClient;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class DocusignController extends Controller
{

    /** hold config value */
    private $config;

    private $signer_client_id = 1000; # Used to indicate that the signer will use embedded

    /** Specific template arguments */
    private $args;


    /**
     * Show the html page
     *
     * @return render
     */

    public function startSigning($appID)
    {
        return redirect()->route('docusign');
    }

    public function index(Request $request)
    {
        // check if path has params
        if ($request->has('event')) {
            $event = $request->event;
            if ($event == 'signing_complete') {
                $auth_form = AuthorizationForm::where('ds_access_token', Session::get('docusign_auth_code'))->first();
                $envelopeApi = new \DocuSign\eSign\Api\EnvelopesApi($this->apiClient());

                $tmp_file = $envelopeApi->getDocument($auth_form->account_id, $auth_form->document_id, $auth_form->envelope_id);

                $file_name = rand() . '.pdf';
                $file_path = storage_path('app/public/authorization/' . $file_name);
                file_put_contents($file_path, file_get_contents($tmp_file->getPathname()));
                $auth_form->signed_document = $file_path;
                $auth_form->save();
                Session::forget('docusign_auth_code');
                return redirect()->route('docusign')->with('success', 'Document Signed Successfully');
            }
        }

        return view('docusign.connect');
    }


    /**
     * Connect your application to docusign
     *
     * @return url
     */
    public function connectDocusign()
    {

        try {
            $params = [
                'response_type' => 'code',
                'scope' => 'signature',
                'client_id' => env('DOCUSIGN_CLIENT_ID'),
                'state' => 'a39fh23hnf23',
                'redirect_uri' => route('docusignCallback'),
            ];
            $queryBuild = http_build_query($params);

            $url = "https://account-d.docusign.com/oauth/auth?";

            $botUrl = $url . $queryBuild;

            return redirect()->to($botUrl);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something Went wrong !');
        }
    }

    /**
     * This function called when you auth your application with docusign
     *
     * @return url
     */
    public function callback(Request $request)
    {
        $code = $request->code;

        $client_id = env('DOCUSIGN_CLIENT_ID');
        $client_secret = env('DOCUSIGN_CLIENT_SECRET');

        $integrator_and_secret_key = "Basic " . utf8_decode(base64_encode("{$client_id}:{$client_secret}"));

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://account-d.docusign.com/oauth/token');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        $post = array(
            // 'grant_type' => 'authorization_code',
            // 'code' => $code,
            'grant_type' => 'client_credentials',
            'scope' => 'signature',
            'client_id' => $client_id,
            'client_secret' => $client_secret,
        );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        $headers = array();
        $headers[] = 'Cache-Control: no-cache';
        $headers[] = "Authorization: $integrator_and_secret_key";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        $decodedData = json_decode($result);
        $request->session()->put('docusign_auth_code', $decodedData->access_token);

        return redirect()->route('docusign')->with('success', 'Docusign Succesfully Connected');
    }

    public function signDocument()
    {
        try {
            $this->args = $this->getTemplateArgs();

            $args = $this->args;


            $envelope_args = $args["envelope_args"];

            # Create the envelope request object
            $envelope_definition = $this->make_envelope($args["envelope_args"]);
            $envelope_api = $this->getEnvelopeApi();
            # Call Envelopes::create API method
            # Exceptions will be caught by the calling function

            $api_client = new \DocuSign\eSign\client\ApiClient($this->config);
            // $envelope_api = new \DocuSign\eSign\Api\EnvelopesApi($api_client);
            $results = $envelope_api->createEnvelope($args['account_id'], $envelope_definition);
            $envelope_id = $results->getEnvelopeId();

            $authentication_method = 'None'; # How is this application authenticating
            # the signer? See the `authenticationMethod' definition
            # https://developers.docusign.com/esign-rest-api/reference/Envelopes/EnvelopeViews/createRecipient
            $recipient_view_request = new \DocuSign\eSign\Model\RecipientViewRequest([
                'authentication_method' => $authentication_method,
                'client_user_id' => $envelope_args['signer_client_id'],
                'recipient_id' => '2',
                'return_url' => $envelope_args['ds_return_url'],
                'user_name' => 'shaiv', 
                'email' => 'mozhui.lungdsuo@gmail.com'
            ]);

            $results = $envelope_api->createRecipientView($args['account_id'], $envelope_id, $recipient_view_request);
            // save envelope id and other details in database
            $auth_form = AuthorizationForm::create([
                'unsigned_document' => 'dummy.pdf',
                'envelope_id' => $envelope_id,
                'account_id' => $args['account_id'],
                'ds_access_token' => $args['ds_access_token'],
                'document_id'=>1
            ]);



            return redirect()->to($results['url']);
        } catch (Exception $e) {
            dd($e);
        }
    }


    private function make_envelope($args)
    {
        $filename = 'dummy.pdf';

        $demo_docs_path = asset('doc/' . $filename);



        // $arrContextOptions=array(
        //     "ssl"=>array(
        //         "verify_peer"=>false,
        //         "verify_peer_name"=>false,
        //     ),
        // );
        // set_time_limit(0);
        // $content_bytes = file_get_contents($demo_docs_path,false, stream_context_create($arrContextOptions));
        $pdf = Pdf::loadView('pdf.sample');


        $base64_file_content = base64_encode($pdf->output());


        # Create the document model
        $document = new \DocuSign\eSign\Model\Document([ # create the DocuSign document object
            'document_base64' => $base64_file_content,
            'name' => 'Example document', # can be different from actual file name
            'file_extension' => 'pdf', # many different document types are accepted
            'document_id' => 1, # a label used to reference the doc
        ]);
        # Create the signer recipient model
        $signer = new \DocuSign\eSign\Model\Signer([ # The signer
            'email' => 'mozhui.lungdsuo@gmail.com', 'name' => 'shaiv',
            'recipient_id' => "2", 'routing_order' => "1",
            # Setting the client_user_id marks the signer as embedded
            'client_user_id' => $args['signer_client_id'],
        ]);
        # Create a sign_here tab (field on the document)
        $sign_here = new \DocuSign\eSign\Model\SignHere([ # DocuSign SignHere field/tab
            'anchor_string' => '/sn1/', 'anchor_units' => 'pixels',
            'anchor_y_offset' => '10', 'anchor_x_offset' => '20',
        ]);
        # Add the tabs model (including the sign_here tab) to the signer
        # The Tabs object wants arrays of the different field/tab types
        $signer->settabs(new \DocuSign\eSign\Model\Tabs(['sign_here_tabs' => [$sign_here]]));
        # Next, create the top level envelope definition and populate it.

        $envelope_definition = new \DocuSign\eSign\Model\EnvelopeDefinition([
            'email_subject' => "Please sign this document sent from the CodeHunger",
            'documents' => [$document],
            # The Recipients object wants arrays for each recipient type
            'recipients' => new \DocuSign\eSign\Model\Recipients(['signers' => [$signer]]),
            'status' => "sent", # requests that the envelope be created and sent.
        ]);

        return $envelope_definition;
    }

    /**
     * Getter for the EnvelopesApi
     */
    public function getEnvelopeApi(): EnvelopesApi
    {
        $this->config = new Configuration();
        $this->config->setHost($this->args['base_path']);
        // $this->config->addDefaultHeader('Authorization', 'Bearer ' . $this->args['ds_access_token']);
        $this->config->addDefaultHeader('X-DocuSign-Authentication', $this->getAuthHeader());
        $apiClient = new ApiClient($this->config);

        return new EnvelopesApi($apiClient);
    }
    protected function getAuthHeader()
{
    Log::info(env('DOCUSIGN_CLIENT_ID'));
    return json_encode([
        'Username' => 'yangeruzi@gmail.com',
        'Password' => 'Yngerlkr1!',
        'IntegratorKey' => env('DOCUSIGN_CLIENT_ID')
    ]);
}

    /**
     * Get specific template arguments
     *
     * @return array
     */
    private function getTemplateArgs()
    {

        $envelope_args = [
            'signer_client_id' => $this->signer_client_id,
            'ds_return_url' => route('docusign')
        ];
        $args = [
            'account_id' => env('DOCUSIGN_ACCOUNT_ID'),
            'base_path' => env('DOCUSIGN_BASE_URL'),
            'ds_access_token' => Session::get('docusign_auth_code'),
            'envelope_args' => $envelope_args
        ];

        return $args;
    }
    private function apiClient()
    {
        $config = new Configuration();
        $config->setHost(env('DOCUSIGN_BASE_URL'));
        $config->addDefaultHeader('Authorization', 'Bearer ' . 'eyJ0eXAiOiJNVCIsImFsZyI6IlJTMjU2Iiwia2lkIjoiNjgxODVmZjEtNGU1MS00Y2U5LWFmMWMtNjg5ODEyMjAzMzE3In0.AQoAAAABAAUABwAAZJH3_dXbSAgAAKS0BUHW20gCADPcsSF66INGpetXK3w8STYVAAEAAAAYAAEAAAAFAAAADQAkAAAAMWU5NzJjYTktZGE3OC00ODAwLThhNzMtMzI4YzQ1ZDI0YTQ4IgAkAAAAMWU5NzJjYTktZGE3OC00ODAwLThhNzMtMzI4YzQ1ZDI0YTQ4MAAAZJSz6dXbSDcAxb3Z3P_Z0Eyw_x2gfxAypw.Swr7NcBwcIjFzRyxSbsAuzjYoe63XunYibUAB_yFJdibqtLIi8P5iBLIIpLvE6EPg0KzCnoU93ii2-DthICn3MDAt35NuV_JIFLSVDAU_VIEp5LMP8INq9lx-tKUoeZIW4CwJE0_U8PViABsdWa2igM0Kt9djEvjeZCmDNJa2ji2UH0Nw_BSsKU-kMHfJgMREsduNP9FjBwnE1bcKBxrg14k6Ocd20Bw__UxfpTmchXapYrB7_nd88qPFV-qJBkzSATdO8oVxMNeblr4tOUgBaxguG5ZPW7GhXovczwCoAUR8YyfAuC3UfssF44aOXHIv1I-qs6CfetyhTj-6Qzf-A');
        $apiClient = new ApiClient($config);
        return $apiClient;
    }
    
}

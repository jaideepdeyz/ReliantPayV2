<?php

namespace App\Http\Controllers;

use App\Models\SaleBooking;
use App\Models\ZohoAccessToken;
use App\Service\ZohoTokenService;
use Barryvdh\DomPDF\Facade\Pdf;
use CURLFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use zsign\OAuth;

class ZohoSignController extends Controller
{
    protected $zohoTokenService;
    public function __construct(ZohoTokenService $zohoTokenService)
    {
        $this->zohoTokenService = $zohoTokenService;
    }

    public function index()
    {
        return view('zoho.signin');
    }
    public function signin()
    {
        if (auth()->user()->zohoAccessToken) {
            if (auth()->user()->zohoAccessToken->expires_in > time()) {
                $url = env('ZOHO_BASE_URL') . '/oauth/v2/token?';
                $params = [
                    'refresh_token' => auth()->user()->zohoAccessToken->refresh_token,
                    'client_id' => env('ZOHO_CLIENT_ID'),
                    'client_secret' => env('ZOHO_CLIENT_SECRET'),
                    'grant_type' => 'refresh_token',
                    'scope' => 'ZohoSign.documents.CREATE,ZohoSign.documents.READ,ZohoSign.documents.UPDATE,ZohoSign.documents.DELETE,ZohoSign.documents.all'
                ];
                $url .= http_build_query($params);
                $response = Http::post($url);
              
                $response = json_decode($response->body(), true);
                $access_token = $response['access_token'];
                $expires_in = $response['expires_in'] + time();
                $this->saveToken($access_token, auth()->user()->zohoAccessToken->refresh_token, $expires_in);
                return redirect()->route('zoho');
            }
        }
        $url = env('ZOHO_BASE_URL') . '/oauth/v2/auth?';
        $params = [
            'scope' => 'ZohoSign.documents.CREATE,ZohoSign.documents.READ,ZohoSign.documents.UPDATE,ZohoSign.documents.DELETE,ZohoSign.documents.all',
            'client_id' => env('ZOHO_CLIENT_ID'),
            'response_type' => 'code',
            'redirect_uri' => route('zohoCallback'),
            'access_type' => 'offline',
            'prompt' => 'consent'

        ];
        $url .= http_build_query($params);
        return redirect($url);
    }
    public function callback(Request $request)
    {
        if ($request->has('code')) {
            $code = $request->code;
            $url = env('ZOHO_BASE_URL') . '/oauth/v2/token?';
            $params = [
                'code' => $code,
                'client_id' => env('ZOHO_CLIENT_ID'),
                'client_secret' => env('ZOHO_CLIENT_SECRET'),
                'redirect_uri' => route('zohoCallback'),
                'grant_type' => 'authorization_code',
                'scope' => 'ZohoSign.documents.CREATE,ZohoSign.documents.READ,ZohoSign.documents.UPDATE,ZohoSign.documents.DELETE,ZohoSign.documents.all'
            ];
            $url .= http_build_query($params);
            $response = Http::post($url);
            $response = json_decode($response->body(), true);
            $access_token = $response['access_token'];
            $refresh_token = $response['refresh_token'];
            $expires_in = time() + $response['expires_in'];
            $this->saveToken($access_token, $refresh_token, $expires_in);
            return redirect()->route('zoho');
        }
    }
    private function saveToken($access_token, $refresh_token, $expires_in)
    {
        $token = ZohoAccessToken::where('user_id', auth()->user()->id)->first();
        if ($token) {
            $token->access_token = $access_token;
            $token->refresh_token = $refresh_token;
            $token->expires_in = $expires_in;
            $token->save();
        } else {
            $token = new ZohoAccessToken();
            $token->user_id = auth()->user()->id;
            $token->access_token = $access_token;
            $token->refresh_token = $refresh_token;
            $token->expires_in = $expires_in;
            $token->save();
        }
    }
    public function sendAuthorizationLetter($id)
    {
        $saleBooking = SaleBooking::find($id);
        // $token = $this->zohoTokenService->checkTokenValidityAndReturnAccessToken();
        $token = env('ZOHO_DEV_ACCESS_TOKEN');
        $url = env('ZOHO_SIGN_BASE_URL') . '/api/v1/requests';
        $header = [
            'Authorization' => 'Zoho-oauthtoken ' . $token,
            'Content-Type' => 'multipart/form-data',
            'Accept' => 'application/json'
        ];
        $data = [
            "requests" => [
                "request_name" => "Authorization Letter 1",
                "actions" => [
                    [
                        "recipient_name" => $saleBooking->customer_name,
                        "recipient_email" => $saleBooking->customer_email,
                        "recipient_countrycode" => "",
                        "action_type" => "SIGN",
                        "private_notes" => "Please sign the document to authorize the booking",
                        "signing_order" => 1,
                        "verify_recipient" => true,
                        "verification_type" => "EMAIL",
                        "fields" => [
                            [
                                "field_id" => "50581000000000177",
                                "field_type_name" => "Signature",
                                "field_category" => "image",
                                "field_label" => "Signature",
                                "is_mandatory" => true,
                                "page_no" => 1,
                              
                                "field_name" => "Signature",
                                "y_coord" => 3,
                              
                                "abs_width" => 22,
                                "description_tooltip" => "",
                                "x_coord" => 42,
                                "abs_height" => 2
                            ],
                            [
                                'field_id' => '50581000000000185',
                                'field_type_name' => 'Email',
                                'field_category' => 'textfield',
                                'field_label' => 'Email',
                                'is_mandatory' => true,
                                'page_no' => 1,
                                'field_name' => 'Email',
                                'y_coord' => 30,
                                
                                'abs_width' => 22,
                                'description_tooltip' => '',
                                'x_coord' => 42,
                                'abs_height' => 2
                            ]

                        ],

                    ]
                ],
                "expiration_days" => 1,
                "is_sequential" => true,
                "email_reminders" => true,
                "reminder_period" => 8
            ]
        ];
        Log::info(json_encode($data));
        $pdf = Pdf::loadView('pdf.sample');
        $path = storage_path('app/public/1.pdf');
        $pdf->save($path);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array(
                'file' => new CURLFile($path),
                'data' => json_encode($data)
            ),
            CURLOPT_HTTPHEADER => array(
                "Authorization: Zoho-oauthtoken " . $token,
                "Content-Type: multipart/form-data",
                "Accept: application/json"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            Log::error("cURL Error #:" . $err);
        } else {
            // http response code
            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            Log::info($http_code);
            $response = json_decode($response, true);
            if (isset($response['code'])) {
               Log::error($response['message']);
            }
            Log::info($response);
        }
    }
    public function sendForSigning($id)
    {
        $url = env('ZOHO_SIGN_BASE_URL') . '/api/v1/requests/' . $id . '/submit';
        $token = env('ZOHO_DEV_ACCESS_TOKEN');
        $data = [
            "requests" => [
                //  "request_name" => "Authorization Letter",
                "actions" => [
                    [
                        'action_type' => 'SIGN',
                        "action_id" => '50581000000031056',
                        "verify_recipient" => false,
                        "private_notes" => "Please sign the document to authorize the booking",
                        "signing_order" => 0,
                        // "fields" => [
                          
                        //     [
                        //         "field_id" => "50581000000000177",
                        //         "field_type_name" => "Signature",
                        //         "field_category" => "image",
                        //         "field_label" => "Signature",
                        //         "is_mandatory" => true,
                        //         "page_no" => 1,
                        //         "document_id" => '50581000000031040',
                        //         "field_name" => "Signature",
                        //         "y_coord" => 50,
                        //         "action_id" => "50581000000031056",
                        //         "abs_width" => 22,
                        //         "description_tooltip" => "",
                        //         "x_coord" => 42,
                        //         "abs_height" => 2
                        //     ],
                        //     [
                        //         'field_id' => '50581000000000185',
                        //         'field_type_name' => 'Email',
                        //         'field_category' => 'textfield',
                        //         'field_label' => 'Email',
                        //         'is_mandatory' => true,
                        //         'page_no' => 1,
                        //         "text_property"=> [
                        //             "is_italic"=> false,
                        //             "is_underline"=> false,
                        //             "font_color"=> "000000",
                        //             "font_size"=> 11,
                        //             "is_read_only"=> false,
                        //             "is_bold"=> false,
                        //             "font"=> "Arial"
                        //         ],
                        //         'document_id' => '50581000000031056',
                        //         'field_name' => 'Email',
                        //         'y_coord' => 90,
                        //         'action_id' => '50581000000031028',
                        //         'abs_width' => 22,
                        //         'description_tooltip' => '',
                        //         'x_coord' => 42,
                        //         'abs_height' => 2
                        //     ]
                          
                        // ],

                    ]
                ]
            ]
        ];
        Log::info(json_encode($data));
        $postData = [
            'data' => json_encode($data)
        ];
        $header = [
            'Authorization' => 'Zoho-oauthtoken ' . $token,
            'Content-Type: application/x-www-form-urlencoded',
        ];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>  http_build_query($postData),
            CURLOPT_HTTPHEADER => array(
                "Authorization: Zoho-oauthtoken " . $token,
                'Content-Type: application/x-www-form-urlencoded',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        Log::info($response);
    }
}

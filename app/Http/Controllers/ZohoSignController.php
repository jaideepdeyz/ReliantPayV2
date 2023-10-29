<?php

namespace App\Http\Controllers;

use App\Models\SaleBooking;
use App\Models\ZohoAccessToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use zsign\OAuth;

class ZohoSignController extends Controller
{
    public function index()
    {
        return view('zoho.signin');
    }
    public function signin()
    {
        $url = 'https://accounts.zoho.com/oauth/v2/auth?';
        $params = [
            'scope' => 'ZohoSign.documents.all',
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
        $code = $request->code;
        $url = 'https://accounts.zoho.com/oauth/v2/token?';
        $params = [
            'code' => $code,
            'client_id' => env('ZOHO_CLIENT_ID'),
            'client_secret' => env('ZOHO_CLIENT_SECRET'),
            'redirect_uri' => route('zohoCallback'),
            'grant_type' => 'authorization_code',
            'scope' => 'ZohoSign.documents.all'
        ];
        $url.= http_build_query($params);

        $response =Http::post($url);
        $response = json_decode($response);
        $access_token = $response->access_token;
        $refresh_token = $response->refresh_token;
        $expires_in = $response->expires_in;
        $expires_in = time() + $expires_in;
        $this->saveToken($access_token, $refresh_token, $expires_in);
        return redirect()->route('zoho');
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
            $token->access_token = $access_token;
            $token->refresh_token = $refresh_token;
            $token->expires_in = $expires_in;
            $token->save();
        }
    }
    
}

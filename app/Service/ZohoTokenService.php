<?php
namespace App\Service;

use App\Models\ZohoAccessToken;
use Illuminate\Support\Facades\Http;

class ZohoTokenService{
    public function checkTokenValidityAndReturnAccessToken(){
        if(auth()->user()->zohoAccessToken){
            if(auth()->user()->zohoAccessToken->expires_in > time()){
                $url=env('ZOHO_BASE_URL').'/oauth/v2/token?';
                $params=[
                    'refresh_token'=>auth()->user()->zohoAccessToken->refresh_token,
                    'client_id'=>env('ZOHO_CLIENT_ID'),
                    'client_secret'=>env('ZOHO_CLIENT_SECRET'),
                    'grant_type'=>'refresh_token',
                    'scope'=>'ZohoSign.documents.CREATE,ZohoSign.documents.READ,ZohoSign.documents.UPDATE,ZohoSign.documents.DELETE,ZohoSign.documents.all'
                ];
                $url.=http_build_query($params);
                $response=Http::post($url);
                $response=json_decode($response->body(),true);
                $access_token=$response['access_token'];
                $expires_in=$response['expires_in']+time();
                $token = ZohoAccessToken::where('user_id', auth()->user()->id)->first();
                $token->access_token = $access_token;
                $token->refresh_token = auth()->user()->zohoAccessToken->refresh_token;
                $token->expires_in = $expires_in;
                $token->save();
                return $token->access_token;
            }
            return auth()->user()->zohoAccessToken->access_token;
        }
        return redirect()->route('zoho');
    }
  
}
<?php
namespace App\Service;

use Illuminate\Support\Facades\Http;

class TrueDialogSmsService{



    public $apiUrl='https://api.truedialog.com/api/v2.1';
    public $apiKey='69eb8e808589447490628cc2de9adc07';
    public $apiSecret='4y/TwR8%3{Lj';
    public $longCode='+16692373340';
    public $accountId='23986';

    public function __construct()
    {
       
    }

    public function sendSms($to, $message)
    {       
        if(substr($to,0,1)!='+'){
            throw new \Exception('Phone number must begin with + sign');
        }

        $http=Http::withBasicAuth($this->apiKey,$this->apiSecret)->post($this->apiUrl.'/account/'.$this->accountId.'/action-pushCampaign',[
            'channels'=>[
                $this->longCode]
            ,
            'targets'=>[
                $to
            ],
            'message'=>$message,
            'execute'=>true,
        ]);
        if($http->successful()){
            return true;
        }
        return false;
    }
    
}
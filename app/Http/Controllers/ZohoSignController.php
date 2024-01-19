<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Models\AuthorizationForm;
use App\Models\SaleBooking;
use App\Models\ZohoAccessToken;
use App\Service\ZohoTokenService;
use Barryvdh\DomPDF\Facade\Pdf;
use CURLFile;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use zsign\api\Actions;
use zsign\api\Fields;
use zsign\api\fields\ImageField;
use zsign\api\RequestObject;
use zsign\OAuth;
use zsign\SignException;
use zsign\ZohoSign;

class ZohoSignController extends Controller
{

    /**
     * Authorize and send document to customer
     *
     * @param [type] $id sale booking id
     * @return void
     */
    public function authorizeAndSend($id)
    {
        try {
            $saleBooking = SaleBooking::find($id);
            /**
             * TODO : check if the document is already sent to customer
             * if yes then redirect back with error message
             * or give option to resend the document
             *
             *
             */



            $user = new OAuth([
                OAuth::CLIENT_ID => env('ZOHO_CLIENT_ID'),
                OAuth::CLIENT_SECRET => env('ZOHO_CLIENT_SECRET'),
                OAuth::DC => 'com',
                // OAuth::ACCESS_TOKEN => env('ZOHO_DEV_ACCESS_TOKEN'),
                OAuth::REFRESH_TOKEN => env('ZOHO_DEV_REFRESH_TOKEN'),
            ]);
            ZohoSign::setCurrentUser($user);
            $reqObject = new RequestObject();
            $reqObject->setRequestName('Authorization Letter for ' . $saleBooking->customer_name);
            $partner = new Actions();
            $partner->setRecipientName($saleBooking->customer_name);
            $partner->setRecipientEmail($saleBooking->customer_email);
            $partner->setRecipientCountrycode('');
            $partner->setActionType(Actions::SIGNER);
            $partner->setPrivateNotes('Please sign the document to authorize the booking');
            $partner->setSigningOrder(1);
            $partner->setVerifyRecipient(true);
            $partner->setVerificationType(Actions::EMAIL);
            $reqObject->addAction($partner);
            $reqObject->setExpirationDays(1);
            $pdf = Pdf::loadView('pdf.sample');
            $path = storage_path('app/public/Unsigned/'.$saleBooking->id.'.pdf');
            $pdf->save($path);
            Log::info($path);
            $files = [
                new CURLFile($path)
            ];
            Log::info('here');
            $draftJSON = ZohoSign::draftRequest($reqObject, $files);
            $sign1 = new ImageField();
            $sign1->setFieldTypeName(ImageField::SIGNATURE);
            $sign1->setPageNum(0);
            $sign1->setDocumentId($draftJSON->getDocumentIds()[0]->getDocumentId());
            $sign1->setFieldName('Signature');
            $sign1->setX_value(53);
            $sign1->setY_value(51);
            $sign1->setHeight(2);
            $sign1->setWidth(16);
            $sign1->setIsMandatory(true);
            $fields = new Fields();
            $fields->addImageField($sign1);
            $action = $draftJSON->getActions();
            $action0 = $action[0];
            $action0->setFields($fields);
            $action[0] = $action0;
            $draftJSON->setActions($action);
            $sfs_resp    = ZohoSign::submitForSignature($draftJSON);
            Log::info($sfs_resp->getRequestId());
            Log::info($sfs_resp->getRequestStatus());

            $authForm = AuthorizationForm::create([
                'app_id' => $saleBooking->id,
                'unsigned_document' => $path,
                'request_id' => $sfs_resp->getRequestId(),
                'document_id' => $draftJSON->getDocumentIds()[0]->getDocumentId(),
            ]);

            $saleBooking->update([
                'app_status' => StatusEnum::PENDING->value,
            ]);

            return redirect()->route('dashboard');
        } catch (SignException $e) {
            Log::info($e);
            return redirect()->back()->with('error', $e);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function zohoWebhook(Request $request)
    {
        try{

            /*********
                STEP 1 : Set user credentials
            **********/

            $user = new OAuth([
                OAuth::CLIENT_ID => env('ZOHO_CLIENT_ID'),
                OAuth::CLIENT_SECRET => env('ZOHO_CLIENT_SECRET'),
                OAuth::DC => 'in',
                // OAuth::ACCESS_TOKEN => env('ZOHO_DEV_ACCESS_TOKEN'),
                OAuth::REFRESH_TOKEN => env('ZOHO_DEV_REFRESH_TOKEN'),
            ]);

            ZohoSign::setCurrentUser( $user );

            /*********
            STEP 2 : Download document
            **********/

            $postBody = file_get_contents("php://input");
            if( $postBody == "" ){
                throw new Exception('post contents are empty ');
            }
            $data_json = json_decode( $postBody, true );

            if( isset( $data_json["notifications"] ) ){
                if( $data_json["notifications"]["operation_type"]=="RequestCompleted" ){

                    $completed_request_id = $data_json["requests"]["request_id"];

                    $completed_request_id = $data_json["requests"]["request_id"];
                    // $directory = "zoho-sign/$completed_request_id";
                    // Storage::makeDirectory($directory);
                    $path = "app/public/Signed/";
                    ZohoSign::setDownloadPath(storage_path($path));

                    ZohoSign::downloadRequest($completed_request_id);
                    ZohoSign::downloadCompletionCertificate($completed_request_id);
                    $authForm = AuthorizationForm::where('request_id', $completed_request_id)->first();
                    ZohoSign::getRequest($completed_request_id);

                    $saleBooking = SaleBooking::find($authForm->app_id);

                    $authForm->update([
                        'signed_document' => 'public/Signed/Authorization Letter for ' . $saleBooking->customer_name.'.pdf',
                        'completion_certificate' => 'public/Signed/completion certificate-Authorization Letter for ' . $saleBooking->customer_name.'.pdf',
                    ]);
                    $saleBooking->update([
                        'app_status' => StatusEnum::AUTHORIZED->value,
                    ]);

                }else{
                    // webhook for someother action
                    throw new Exception("Error Processing Request - 2", 2);
                }
            }else{
                // wrong json,  not of webooks
                throw new Exception("Error Processing Request - 1 : $postBody", 1);

            }


        }catch( SignException $signEx ){
            // log it
            Log::info($signEx);
            // echo "SIGN EXCEPTION : ".$signEx;
        }catch( Exception $ex ){
            Log::info($ex->getMessage());
        }
    }
}

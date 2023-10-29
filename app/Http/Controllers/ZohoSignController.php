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
                OAuth::DC => 'in',
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
            $path = storage_path('app/public/1.pdf');
            $pdf->save($path);
            $files = [
                new CURLFile($path)
            ];
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
            /**
             * TODO : save request id and request status in sale booking table or somewhere else
             * maybe in a new table.
             * 
             *  
             */
            
            return redirect()->back()->with('success', 'Document sent successfully');
        } catch (SignException $e) {
            Log::info($e);
            return redirect()->back()->with('error', $e);
        
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}

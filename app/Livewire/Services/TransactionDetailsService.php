<?php

namespace App\Livewire\Services;

use App\Enums\ServiceEnum;
use App\Models\SaleBooking;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class TransactionDetailsService extends Component
{
    public $appID;
    public $saleBooking;
    public $mco_amount;
    public $ticket_amount;

    public function mount($appID)
    {
        $this->appID = $appID;
        $this->saleBooking = SaleBooking::where('id', $this->appID)->first();
        // $transaction = TransactionDetail::where('sale_booking_id', $this->appID)->first();
        // if($transaction){
        //     $this->mco_amount = $transaction->mco_amount;
        //     $this->ticket_amount = $transaction->ticket_amount;
        // }
    }

    public function save()
    {
        $this->validate([
            'mco_amount' => 'required|numeric',
            'ticket_amount' => 'required|numeric',
        ]);

       try {
        DB::beginTransaction();
        // if booking type is cancellation then no ticket charges
        if($this->saleBooking->sale_type == 'cancellation'){
            $this->ticket_amount = 0;
        }

        $transaction = TransactionDetail::updateOrCreate(
            ['sale_booking_id' => $this->appID],
            [
                'mco_amount' => $this->mco_amount,
                'ticket_amount' => $this->ticket_amount,
                'total_amount' => $this->mco_amount + $this->ticket_amount,
            ]
        );
        DB::commit();
       } catch (\Exception $e) {
            DB::rollback();
           dd($e->getMessage());
       }
    }

    public function nextStep()
    {
        Session::flash('message', ['heading'=>'success','text'=>'Transaction Details Saved Successfully']);
        return redirect()->route('addChargeDetails', ['appID' => $this->appID]);
    }


    public function previousStep()
    {
        Session::flash('message', ['heading'=>'success','text'=>'Transaction Charges Details Saved Successfully']);
        return redirect()->route('addPassengers', ['appID' => $this->appID]);
    }


    public function render()
    {
        $transactionDetails = TransactionDetail::where('sale_booking_id', $this->appID)->first();
        return view('livewire.services.transaction-details-service', [
            'transactionDetails' => $transactionDetails,
        ])->layout('layouts.dashboard-layout');
    }
}

<?php

namespace App\Livewire\Modals;

use App\Enums\RoleEnum;
use App\Enums\StatusEnum;
use App\Livewire\Agents\BookSales;
use App\Models\BookingCancellation;
use App\Models\SaleBooking;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CancelBooking extends Component
{

    use WithFileUploads;
    
    public $appID;
    public $booking;
    public $bookingType;
    public $isTicketIssued = 'No';
    public $remarks;
    public $receipt;
    public $cancellation_charges;
    public $refund_amount;

    public $cancellationRequested = 'No';
    public $refundRequested = 'No';

    public function mount($appID)
    {
        $this->appID = $appID;
        $saleBooking = SaleBooking::find($appID);
        $this->bookingType = $saleBooking->sale_type;
        $this->booking = $saleBooking;

        if($saleBooking->confirmation_number != null)
        {
            $this->isTicketIssued = 'Yes';
        }

        switch($saleBooking->app_status)
        {
            case StatusEnum::CANCELLATION_REQUESTED->value:
                $this->cancellationRequested = 'Yes';
                break;
            case StatusEnum::REFUND_REQUESTED->value:
                $this->refundRequested = 'Yes';
                break;
            default:
                $this->cancellationRequested = 'No';
                $this->refundRequested = 'No';
                break;
        }
        
    }

    public function cancelBooking()
    {
        try {
            DB::beginTransaction();
            switch(auth()->user()->role)
            {
                    case RoleEnum::AGENT->value:
                        if($this->bookingType == 'Cancellation')
                        {
                            DB::beginTransaction();
                                $bookingCancellation = BookingCancellation::updateOrCreate(
                                    ['app_id' => $this->appID],
                                    [
                                        'agent_id' => auth()->user()->id,
                                        'organization_id' => auth()->user()->organization_id,
                                        'remarks' => $this->remarks,
                                    ]
                                );
                
                            
                                if($bookingCancellation->cancellation_receipt != null)
                                {
                                    $status = StatusEnum::TICKET_CANCELLED->value;
                                }
                                else
                                {
                                    $status = StatusEnum::CANCELLATION_REQUESTED->value;
                                }

                                $sale = SaleBooking::find($this->appID);
                                $sale->update([
                                    'app_status' => $status,
                                ]);
                
                        
                        
                        } 
                        else 
                        {
                            $bookingCancellation = BookingCancellation::updateOrCreate(
                                ['app_id' => $this->appID],
                                [
                                    'agent_id' => auth()->user()->id,
                                    'organization_id' => auth()->user()->organization_id,
                                    'remarks' => $this->remarks,
                                ]
                            );

                            if($this->isTicketIssued == 'Yes')
                            {
                                    $status = StatusEnum::REFUND_REQUESTED->value;
                            }
                            else
                            {
                                    $status = StatusEnum::TICKET_CANCELLED->value;
                            }

                            $sale = SaleBooking::find($this->appID);
                            $sale->update([
                                'app_status' => $status,
                            ]);
                        }
                    break;

                    case RoleEnum::FINANCE->value:
                        $bookingCancellation = BookingCancellation::updateOrCreate(
                            ['app_id' => $this->appID],
                            [
                                'agent_id' => auth()->user()->id,
                                'organization_id' => auth()->user()->organization_id,
                                'remarks' => $this->remarks,
                            ]
                        );

                        // todo store cancellation receipt if file is uploaded 

                        if($bookingCancellation->cancellation_receipt != null)
                        {
                            $status = StatusEnum::REFUNDED->value;
                        }
                        else
                        {
                            $status = StatusEnum::REFUND_REQUESTED->value;
                        }

                        $sale = SaleBooking::find($this->appID);
                        $sale->update([
                            'app_status' => $status,
                        ]);
                    break;
            }
            DB::commit();
            $this->dispatch('hideModal');
            $this->dispatch('operationCompleted')->to(BookSales::class);
            return redirect()->route('bookSales');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
       
    }

    public function saveCancellation()
    {
        $this->validate([
            'receipt' => 'required|mimes:jpeg,jpg,png',
        ], [
            'receipt.required' => 'Please upload a receipt',
            'receipt.mimes' => 'Please upload a valid image file',
        ]);

        try {
            DB::beginTransaction();
            BookingCancellation::updateOrCreate(
                ['app_id' => $this->appID],
                [
                    'agent_id' => auth()->user()->id, 
                    'organization_id' => auth()->user()->organization->id,
                    'remarks' => $this->remarks,
                    'cancellation_charges' => $this->cancellation_charges,
                    'refund_amount' => $this->refund_amount,
                    'cancellation_receipt' => $this->receipt->storeAs('public/CancellationReceipts/' . $this->appID, 'cancellationReceipt_' .$this->appID .'.'. $this->receipt->getClientOriginalExtension()),
                ]);
    
                switch (auth()->user()->role) {
                    case RoleEnum::AGENT->value:
                        $status = StatusEnum::TICKET_CANCELLED->value;
                        break;
                    default:
                        $status = StatusEnum::REFUNDED->value;
                        break;
                }
    
                $booking = SaleBooking::find($this->appID);
                
                $booking->update([
                    'app_status' => $status,
                ]);
                DB::commit();
                $this->dispatch('hideModal');
                $this->dispatch('operationCompleted')->to(BookSales::class);
                return redirect()->route('bookSales');

        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('hideModal');
            $this->dispatch('operationFailed')->to(BookSales::class);
        }
    }

    public function render()
    {
        return view('livewire.modals.cancel-booking');
    }
}

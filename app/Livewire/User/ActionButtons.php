<?php

namespace App\Livewire\User;

use App\Enums\ServiceEnum;
use App\Enums\StatusEnum;
use App\Livewire\Agents\BookSales;
use App\Models\SaleBooking;
use App\Models\TransactionLog;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class ActionButtons extends Component
{
    public $appID;
    public $sale;
    public $bookingStatus;
    public $bookingType;

    public $selectedID;
    public $status;
    public $remarks;

    #[On('operationCompleted')]
    public function operationCompleted()
    {
        $this->render();
    }

    public function mount($appID)
    {
        $this->appID = $appID;
        $this->sale = SaleBooking::where('id', $appID)->first();
        $this->bookingStatus = $this->sale->app_status;
        $this->bookingType = $this->sale->sale_type;

    }

    public function deleteSale($id)
    {
        $this->selectedID = $id;
        $target = SaleBooking::find($this->selectedID);
        try {
            DB::beginTransaction();
            if($target->flightBooking != null)
                {
                    $target->flightBooking()->delete();
                }
            if($target->amtrakBooking != null)
                {
                    $target->amtrakBooking()->delete();
                }
            if($target->payment != null)
                {
                    $target->payment()->delete();
                }
            if($target->passengers != null)
                {
                    $target->passengers()->delete();
                }
            $target->delete();

            $this->status = StatusEnum::DELETED;
            $this->remarks = 'Booking Deleted';
            $this->transactionLog();

            DB::commit();
            $this->reset('selectedID');
            $this->dispatch('operationCompleted')->self();
            $this->dispatch('message', heading:'success',text:'Booking deleted')->to(BookSales::class);
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }
    }

    public function viewBooking($bookingID)
    {
        // dd($bookingID);
        $sale = SaleBooking::find($bookingID);
        switch($sale->service->service_name)
        {
            case ServiceEnum::FLIGHTS->value:
                return redirect()->route('flightBooking', ['appID' => $bookingID]);
            case ServiceEnum::AMTRAK->value:
                return redirect()->route('amtrakBooking', ['appID' => $bookingID]);
            default:
                return redirect()->back();
        }
    }

    public function transactionLog()
    {
            TransactionLog::create([
                'organization_id' => auth()->user()->organization_id,
                'user_id' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
                'sales_id' => $this->sale->id,
                'type' => 'Sales',
                'status' => $this->status,
                'remarks' => $this->remarks,
            ]);
    }

    public function render()
    {
        return view('livewire.user.action-buttons');
    }
}

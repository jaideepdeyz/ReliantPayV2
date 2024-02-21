<?php

namespace App\Livewire\Modals;

use App\Enums\ServiceEnum;
use App\Enums\StatusEnum;
use App\Livewire\Agents\BookSales;
use App\Models\CustomerMaster;
use App\Models\OrganizationServiceMap;
use App\Models\SaleBooking;
use App\Models\ServiceMaster;
use App\Models\TransactionLog;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class NewSale extends Component
{
    public $sale_type;
    public $title;
    public $agent_name;
    // public $service_id;
    public $serviceName;
    public $customer_name;
    public $customer_phone;
    public $customer_email;
    public $sale;
    public $status;
    public $remarks;
    public $search;
    public $statusSearch;
    public $selectedID;
    public $customer_dob;
    public $customer_gender;
    public $relationship_to_card_holder;

    public function mount($title)
    {
        $this->title = $title;
        if($title == 'Sale') {
            $this->sale_type = 'New';
        } else {
            $this->sale_type = 'Cancellation';
        }
    }

    public function storeSaleBooking()
    {
        $this->validate([
            'serviceName' => 'required',
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'customer_email' => 'required',
            'customer_dob' => 'required',
            'customer_gender' => 'required',
            'relationship_to_card_holder' => 'required',
            'sale_type' => 'required',
        ], [
            'serviceName.required' => 'Service is required',
            'customer_name.required' => 'Customer Name is required',
            'customer_phone.required' => 'Customer Phone is required',
            'customer_email.required' => 'Customer Email is required',
            'customer_dob.required' => 'Customer Date of Birth is required',
            'customer_gender.required' => 'Customer Gender is required',
            'relationship_to_card_holder.required' => 'Relationship to Card Holder is required',
            'sale_type.required' => 'Sale Type is required',
        ]);

        try {
            DB::beginTransaction();

            //checking uniqueness of customer email
            $customer = CustomerMaster::where('customer_email', $this->customer_email)->first();
            if(!$customer)
            {
                $customer = CustomerMaster::create([
                    'customer_email' => $this->customer_email,
                    'customer_name' => $this->customer_name,
                    'customer_gender' => $this->customer_gender,
                    'customer_dob' => $this->customer_dob,
                ]);
            }


            // getting the service id from services table

            $service = ServiceMaster::where('service_name', $this->serviceName)->first();

            $this->sale = SaleBooking::create([
                'agent_id' => auth()->user()->id,
                'organization_id' => auth()->user()->organization_id,
                'service_id' => $service->id,
                'sale_type' => $this->sale_type,
                'customer_id' => $customer->id,
                'customer_name' => $this->customer_name,
                'customer_gender' => $this->customer_gender,
                'customer_dob' => $this->customer_dob,
                'customer_email' => $this->customer_email,
                'customer_phone' => $this->customer_phone,
                'app_status' => StatusEnum::DRAFT,
                'relationship_to_card_holder' => $this->relationship_to_card_holder,
            ]);
            $this->status = StatusEnum::DRAFT;
            $this->remarks =  $this->title .' Booking Added';
            $this->transactionLog();

            DB::commit();
            $this->reset(['serviceName', 'customer_name', 'customer_phone', 'customer_email', 'customer_dob', 'customer_gender']);
            $this->dispatch('hideModal');

            switch($this->sale->service->service_name)
            {
                case ServiceEnum::FLIGHTS->value:
                    return redirect()->route('flightBooking', ['appID' => $this->sale->id]);
                case ServiceEnum::AMTRAK->value:
                    return redirect()->route('amtrakBooking', ['appID' => $this->sale->id]);
                default:
                    return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            $this->dispatch('message', heading:'error', text:$e->getMessage())->to(BookSales::class);
            $this->dispatch('hideModal');
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
        $services = OrganizationServiceMap::where('organization_id', auth()->user()->organization_id)
        ->where('service_status', 'Activated')
        ->get();
        return view('livewire.modals.new-sale', compact('services'));
    }
}

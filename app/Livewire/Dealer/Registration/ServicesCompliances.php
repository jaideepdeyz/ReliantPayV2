<?php

namespace App\Livewire\Dealer\Registration;

use App\Models\Organization;
use App\Models\OrganizationServiceMap;
use App\Models\ProductService;
use App\Models\ServiceMaster;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ServicesCompliances extends Component
{
    public $orgID;
    public $business_product_services = [];
    public $business_PCI_DSS_compliance_status;
    public $business_HTTPS_compliance_status;
    public $viewOnly = 'No';
    public $productsServices = [];
    public $orgProductsServices = [];

    public function mount($orgID, $viewOnly = null)
    {
        $org = Organization::find($orgID);
        if($org)
        {
            $this->business_PCI_DSS_compliance_status = $org->business_PCI_DSS_compliance_status;
            $this->business_HTTPS_compliance_status = $org->business_HTTPS_compliance_status;
        }

        $this->viewOnly = $viewOnly;
        if($this->viewOnly != null)
        {
            $this->viewOnly = 'Yes';
            $this->orgProductsServices = OrganizationServiceMap::where('organization_id', $orgID)->get();
        }

        // if($org->productsServices)
        // {
        //     $this->business_product_services = ProductService::where('organization_id', $orgID)->get();
        // }

    }

    public function save()
    {
        try {
            DB::beginTransaction();
            $org = Organization::find($this->orgID);
            $org->update([
                'business_PCI_DSS_compliance_status' => $this->business_PCI_DSS_compliance_status,
                'business_HTTPS_compliance_status' => $this->business_HTTPS_compliance_status,
            ]);

            $existingServices = OrganizationServiceMap::where('organization_id', $org->id)->get();
            foreach($existingServices as $existingService)
            {
                $existingService->delete();
            }

            //storing Services and Products of an Organization
            foreach($this->business_product_services as $key=> $service){


                if($service == true)
                {
                    $service = ServiceMaster::where('service_name', $key)->first();
                    OrganizationServiceMap::create([
                        'organization_id' => $org->id,
                        'service_name' => $service->service_name,
                        'service_id' => $service->id,
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('dealerBankingDetails', ['orgID' => $this->orgID]);
        } catch(\Exception $e){
            DB::rollBack();
            dd($e->getMessage());
        }


    }

    public function decreaseStep()
    {
        return redirect()->route('dealerRegBusinessInfo');
    }

    public function render()
    {
        $services = ProductService::all();
        return view('livewire.dealer.registration.services-compliances', [
            'services' => $services
        ])->layout('layouts.dashboard-layout');
    }
}

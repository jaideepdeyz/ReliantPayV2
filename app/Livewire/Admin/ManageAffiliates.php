<?php

namespace App\Livewire\Admin;

use App\Models\Affiliate;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ManageAffiliates extends Component
{
    use WithPagination;

    #[On('updated')]
    public function updated()
    {
        $this->render();
    }
    public function render()
    {
        $affiliates = Affiliate::with('user')->paginate(10);

        return view('livewire.admin.manage-affiliates',
            compact('affiliates')
        )->layout('layouts.dashboard-layout');
    }
}

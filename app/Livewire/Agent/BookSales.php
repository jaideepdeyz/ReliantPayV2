<?php

namespace App\Livewire\Agent;

use Livewire\Component;

class BookSales extends Component
{
    
    public function render()
    {
        return view('livewire.agent.book-sales')->layout('layouts.dashboard-layout');
    }
}

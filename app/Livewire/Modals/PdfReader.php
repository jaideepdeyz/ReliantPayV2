<?php

namespace App\Livewire\Modals;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class PdfReader extends Component
{
    public $url;
    public $title;

    public function mount($url, $title)
    {
        $this->url = Storage::URL($url);
        $this->title = $title;
    }

    public function render()
    {
        return view('livewire.modals.pdf-reader');
    }
}

<?php

namespace App\Livewire\Modals;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class PdfReader extends Component
{
    public $url;
    public $title;
    public $type;

    public function mount($url, $title,$type=null)
    {
        $this->url = Storage::URL($url);
        $this->title = $title;
        $this->type = $type;
    }

    public function render()
    {
        return view('livewire.modals.pdf-reader');
    }
}

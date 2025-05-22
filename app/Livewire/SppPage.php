<?php

namespace App\Livewire;

use App\Models\Spp;
use Livewire\Component;

class SppPage extends Component
{
    public $sppList;
    public function mount()
    {
        $this->sppList = Spp::orderBy('tahun_ajaran', 'DESC')->get();
    }

    public function render()
    {
        return view('livewire.spp-page');
    }
}

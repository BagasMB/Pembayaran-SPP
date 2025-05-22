<?php

namespace App\Livewire;

use App\Models\Major;
use Livewire\Component;

class MajorPage extends Component
{
    public $majors;
    public function mount()
    {
        $this->majors = Major::all();
    }
    public function render()
    {
        return view('livewire.major-page');
    }
}

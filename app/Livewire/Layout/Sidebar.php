<?php

namespace App\Livewire\Layout;

use App\Models\User;
use Livewire\Component;
use App\Models\ClassRoom;
use App\Models\Configuration;

class Sidebar extends Component
{
    public $angkatan, $class, $config;

    public function mount()
    {
        $this->angkatan = User::select('tahun_masuk')->siswa()->distinct()->orderBy('tahun_masuk', 'DESC')->get()->toArray();
        $this->class = ClassRoom::orderBy('name_class', 'ASC')->get();
        $this->config = Configuration::find(1);
    }
    public function render()
    {
        return view('livewire.layout.sidebar');
    }
}

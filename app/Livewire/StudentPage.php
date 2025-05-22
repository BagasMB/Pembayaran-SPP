<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ClassRoom;
use App\Models\User;

class StudentPage extends Component
{
    public $studentList, $classList;

    public function mount()
    {
        $this->studentList = User::with('class')
            ->whereHas('roles', function ($query) {
                $query->where('name', 'Siswa');
            })
            ->orderBy('nis', 'ASC')
            ->get();
        $this->classList = ClassRoom::select('id', 'name_class')->orderBy('name_class', 'ASC')->get();
    }

    public function render()
    {
        return view('livewire.student-page');
    }
}

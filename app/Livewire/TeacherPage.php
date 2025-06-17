<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\ClassRoom;

class TeacherPage extends Component
{
    public $teacherList, $classList;

    public function mount()
    {
        $this->teacherList = User::with('major')->guru()->orderBy('nis', 'ASC')->get();
        $this->classList = ClassRoom::select('id', 'name_class')->orderBy('name_class', 'ASC')->get();
    }

    public function render()
    {
        return view('livewire.teacher-page');
    }
}

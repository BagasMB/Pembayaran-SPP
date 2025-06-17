<?php

namespace App\Livewire\Student;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.guest')]
class CariStudentPage extends Component
{
    public $title = 'Cari Siswa';
    public $students;

    public function mount()
    {
        $this->title;
        $this->students = User::with('class')->siswa()->orderBy('nis', 'ASC')->get();
    }
    public function render()
    {
        return view('livewire.student.cari-student-page');
    }
}

<?php

namespace App\Livewire\Form;

use App\Models\Major;
use Livewire\Component;
use App\Models\ClassRoom;

class FormClass extends Component
{
    public $title;
    public $majors;
    public $classID, $nameClass, $major_id;

    public function mount($title,  $classID = null)
    {
        // dd($classID);
        $this->majors = Major::all();
        $this->title = $title;
        if ($classID != null) {
            $class = ClassRoom::findorfail($classID);
            $this->classID = $class->id;
            $this->nameClass = $class->name_class;
            $this->major_id = $class->major_id;
        }
    }

    public function save()
    {
        $this->validate(
            [
                'nameClass' => 'required',
                'major_id' => 'required',
            ],
            [
                'nameClass.required' => 'Data Nama Kelas wajib Diisi',
                'major_id.required' => 'Data Jurusan wajib Diisi',
            ]
        );

        ClassRoom::create([
            'name_class' => $this->nameClass,
            'major_id' => $this->major_id,
        ]);
        flash()->success('Data Berhasil Di Simpan 🎉');
        $this->reset();
        return redirect('/classroom');
    }

    public function update()
    {
        $this->validate([
            'nameClass' => 'required',
            'major_id' => 'required',
        ], [
            'nameClass.required' => 'Data Nama Kelas wajib Diisi',
            'major_id.required' => 'Data Jurusan wajib Diisi',
        ]);


        $class = ClassRoom::findOrFail($this->classID);
        $class->update([
            'name_class' => $this->nameClass,
            'major_id' => $this->major_id,
        ]);

        flash()->success('Data Berhasil Diupdate 🎉');
        $this->reset();
        return redirect('/classroom');
    }

    public function render()
    {
        return view('livewire.form-class');
    }
}

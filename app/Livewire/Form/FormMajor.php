<?php

namespace App\Livewire\Form;

use App\Models\Major;
use Illuminate\Validation\Rule;
use Livewire\Component;

class FormMajor extends Component
{
    public $title, $majorID, $name;

    public function mount($title,  $majorID = null)
    {
        $this->title = $title;
        if ($majorID != null) {
            $major = Major::findOrFail($majorID);
            $this->majorID = $major->id;
            $this->name = $major->name;
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:majors,name',
        ]);

        Major::create([
            'name' => $this->name,
        ]);

        flash()->success('Data Berhasil Di Simpan 🎉');
        return redirect()->route('major.index');
    }

    public function update()
    {
        $this->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('majors', 'name')->ignore($this->majorID),
            ],
        ]);

        $major = Major::findOrFail($this->majorID);
        $major->update([
            'name' => $this->name,
        ]);

        flash()->success('Data Berhasil Di Simpan 🎉');
        return redirect()->route('major.index');
    }

    public function render()
    {
        return view('livewire.form-major');
    }
}

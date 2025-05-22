<?php

namespace App\Livewire\Form;

use App\Models\User;
use Livewire\Component;
use App\Models\ClassRoom;
use Illuminate\Support\Facades\Hash;

class FormStudent extends Component
{
    public $title;
    public $class;
    public $studentID, $nis, $name, $gender, $class_id, $tanggal_lahir, $tahun_masuk, $telp, $alamat;

    public function mount($title, $studentID = null)
    {
        $this->title = $title;
        $this->class = ClassRoom::all();
        if ($studentID != null) {
            $student = User::with('class')->findorfail($studentID);
            $this->studentID = $studentID;
            $this->nis = $student->nis;
            $this->name = $student->name;
            $this->gender = $student->gender;
            $this->class_id = $student->class_id;
            $this->gender = $student->gender;
            $this->tanggal_lahir = $student->tanggal_lahir;
            $this->tahun_masuk = $student->tahun_masuk;
            $this->telp = $student->telp;
            $this->alamat = $student->alamat;
        }
    }

    public function save()
    {
        $this->validate(
            [
                'nis' => 'required',
                'name' => 'required',
                'class_id' => 'required',
                'gender' => 'required',
                'telp' => 'required',
                'tahun_masuk' => 'required',
                'tanggal_lahir' => 'required',
                'alamat' => 'required',
            ],
            [
                'nis.required' => 'Nis wajib Diisi',
                'name.required' => 'Nama Siswa wajib Diisi',
                'class_id.required' => 'Kelas wajib Diisi',
                'gender.required' => 'Jenis Kelamin wajib Diisi',
                'tahun_masuk.required' => 'Tahun Masuk wajib Diisi',
                'tanggal_lahir.required' => 'Tanggal Lahir wajib Diisi',
                'alamat.required' => 'Alamat wajib Diisi',
            ]
        );

        $useer =  User::create([
            'nis' => $this->nis,
            'name' => $this->name,
            'email' => emailFormat($this->name),
            'username' => usernameFormat($this->name),
            'password' => Hash::make('123'),
            'class_id' => $this->class_id,
            'gender' => $this->gender,
            'telp' => $this->telp,
            'tahun_masuk' => $this->tahun_masuk,
            'tanggal_lahir' => $this->tanggal_lahir,
            'alamat' => $this->alamat,
        ]);
        $useer->assignRole('Siswa');
        flash()->success('Data Berhasil Di Simpan 🎉');
        return redirect('/student');
    }

    public function update()
    {
        $this->validate(
            [
                'nis' => 'required',
                'name' => 'required',
                'class_id' => 'required',
                'gender' => 'required',
                'telp' => 'required',
                'tahun_masuk' => 'required',
                'tanggal_lahir' => 'required',
                'alamat' => 'required',
            ],
            [
                'nis.required' => 'Nis wajib Diisi',
                'name.required' => 'Nama Siswa wajib Diisi',
                'class_id.required' => 'Kelas wajib Diisi',
                'gender.required' => 'Jenis Kelamin wajib Diisi',
                'tahun_masuk.required' => 'Tahun Masuk wajib Diisi',
                'tanggal_lahir.required' => 'Tanggal Lahir wajib Diisi',
                'alamat.required' => 'Alamat wajib Diisi',
            ]
        );

        $useer = User::findOrFail($this->studentID);
        $useer->update([
            'nis' => $this->nis,
            'name' => $this->name,
            'email' => emailFormat($this->name),
            'username' => usernameFormat($this->name),
            'password' => Hash::make('123'),
            'class_id' => $this->class_id,
            'gender' => $this->gender,
            'telp' => $this->telp,
            'tahun_masuk' => $this->tahun_masuk,
            'tanggal_lahir' => $this->tanggal_lahir,
            'alamat' => $this->alamat,
        ]);
        flash()->success('Data Berhasil Di Simpan 🎉');
        return redirect('/student');
    }

    public function render()
    {
        return view('livewire.form-student');
    }
}

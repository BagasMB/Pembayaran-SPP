<?php

namespace App\Livewire\Form;

use App\Models\User;
use App\Models\Major;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class FormTeacher extends Component
{
    public $title;
    public $majors;
    public $teacherID, $nip, $name, $major_id, $gender, $tanggal_lahir, $tahun_masuk, $telp, $alamat;

    public function mount($title,  $teacherID = null)
    {
        $this->title = $title;
        $this->majors = Major::all();
        if ($teacherID != null) {
            $teacher = User::findorfail($teacherID);
            $this->teacherID = $teacher->id;
            $this->nip = $teacher->nip;
            $this->name = $teacher->name;
            $this->gender = $teacher->gender;
            $this->major_id = $teacher->major_id;
            $this->tanggal_lahir = $teacher->tanggal_lahir;
            $this->tahun_masuk = $teacher->tahun_masuk;
            $this->telp = $teacher->telp;
            $this->alamat = $teacher->alamat;
        }
    }

    public function save()
    {
        $this->validate(
            [
                'nip' => 'required',
                'name' => 'required',
                'major_id' => 'required',
                'gender' => 'required',
                'telp' => 'required',
                'tahun_masuk' => 'required',
                'tanggal_lahir' => 'required',
                'alamat' => 'required',
            ],
            [
                'nip.required' => 'Nip wajib Diisi',
                'name.required' => 'Nama Siswa wajib Diisi',
                'major_id.required' => 'Kelas wajib Diisi',
                'gender.required' => 'Jenis Kelamin wajib Diisi',
                'tahun_masuk.required' => 'Tahun Masuk wajib Diisi',
                'tanggal_lahir.required' => 'Tanggal Lahir wajib Diisi',
                'alamat.required' => 'Alamat wajib Diisi',
            ]
        );

        $useer =  User::create([
            'nip' => $this->nip,
            'name' => $this->name,
            'email' => emailFormat($this->name),
            'username' => usernameFormat($this->name),
            'password' => Hash::make('123'),
            'major_id' => $this->major_id,
            'gender' => $this->gender,
            'telp' => $this->telp,
            'tahun_masuk' => $this->tahun_masuk,
            'tanggal_lahir' => $this->tanggal_lahir,
            'alamat' => $this->alamat,
        ]);
        $useer->assignRole('Guru');
        flash()->success('Data Berhasil Di Simpan 🎉');
        return redirect('/teacher');
    }

    public function update()
    {
        $this->validate(
            [
                'nip' => 'required',
                'name' => 'required',
                'major_id' => 'required',
                'gender' => 'required',
                'telp' => 'required',
                'tahun_masuk' => 'required',
                'tanggal_lahir' => 'required',
                'alamat' => 'required',
            ],
            [
                'nip.required' => 'Nip wajib Diisi',
                'name.required' => 'Nama Siswa wajib Diisi',
                'major_id.required' => 'Kelas wajib Diisi',
                'gender.required' => 'Jenis Kelamin wajib Diisi',
                'tahun_masuk.required' => 'Tahun Masuk wajib Diisi',
                'tanggal_lahir.required' => 'Tanggal Lahir wajib Diisi',
                'alamat.required' => 'Alamat wajib Diisi',
            ]
        );
        $useer = User::findOrFail($this->teacherID);
        $useer->update([
            'nip' => $this->nip,
            'name' => $this->name,
            'email' => emailFormat($this->name),
            'username' => usernameFormat($this->name),
            'password' => Hash::make('123'),
            'major_id' => $this->major_id,
            'gender' => $this->gender,
            'telp' => $this->telp,
            'tahun_masuk' => $this->tahun_masuk,
            'tanggal_lahir' => $this->tanggal_lahir,
            'alamat' => $this->alamat,
        ]);
        flash()->success('Data Berhasil Di Simpan 🎉');
        return redirect('/teacher');
    }

    public function render()
    {
        return view('livewire.form-teacher');
    }
}

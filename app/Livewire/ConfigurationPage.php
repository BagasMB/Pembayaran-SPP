<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Configuration;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class ConfigurationPage extends Component
{
    public $title;
    public $config;

    public $id, $name, $judul, $email, $phone, $alamat, $logo;

    public function mount()
    {
        $this->title = 'Configuration SPP';
        $this->config = Configuration::findOrFail(1);

        // Isi properti form
        $this->id = $this->config->id;
        $this->name = $this->config->name;
        $this->judul = $this->config->judul;
        $this->email = $this->config->email;
        $this->phone = $this->config->phone;
        $this->alamat = $this->config->alamat;
        $this->logo = $this->config->logo;
    }

    public function updateConfig()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'alamat' => 'required|string',
        ]);

        $config = Configuration::findOrFail($this->id);
        $config->update([
            'name' => $this->name,
            'judul' => $this->judul,
            'email' => $this->email,
            'phone' => $this->phone,
            'alamat' => $this->alamat,
        ]);
        $this->config = Configuration::findOrFail($this->id);
        flash()->success('Konfigurasi berhasil diperbarui 🎉');
    }

    public function render()
    {
        return view('livewire.configuration-page');
    }
}

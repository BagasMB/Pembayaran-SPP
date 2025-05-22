<?php

namespace App\Livewire\Form;

use App\Models\Spp;
use Livewire\Component;
use Livewire\Attributes\Validate;

class FormSpp extends Component
{
    public $title;
    // public $sppID, $spp1, $spp2, $spp3, $tahun_ajaran1, $tahun_ajaran2;

    // public function mount($title,  $sppID = null)
    // {
    //     // dd($sppID);
    //     $this->title = $title;
    //     if ($sppID != null) {
    //         $spp = Spp::findOrFail($sppID);
    //         $this->sppID = $spp->id;
    //         $this->spp1 = $spp->spp1;
    //         $this->spp2 = $spp->spp2;
    //         $this->spp3 = $spp->spp3;
    //         $this->tahun_ajaran1 = $spp->tahun_ajaran1;
    //         $this->tahun_ajaran2 = $spp->tahun_ajaran2;
    //     }
    // }

    public ?int $sppID = null;

    #[Validate('required|integer|min:2000|max:9999', as: 'Tahun Ajaran Awal')]
    public $tahun_ajaran1;

    #[Validate('required|integer|min:2000|max:9999', as: 'Tahun Ajaran Akhir')]
    public $tahun_ajaran2;

    #[Validate('required|integer', as: 'SPP 1')]
    public $spp1;

    #[Validate('required|integer', as: 'SPP 2')]
    public $spp2;

    #[Validate('required|integer', as: 'SPP 3')]
    public $spp3;

    public function mount(?int $sppID = null): void
    {
        if ($sppID) {
            $spp = Spp::findOrFail($sppID);
            $this->sppID = $spp->id;
            $this->tahun_ajaran1 = $spp->tahun_ajaran1;
            $this->tahun_ajaran2 = $spp->tahun_ajaran2;
            $this->spp1 = $spp->spp1;
            $this->spp2 = $spp->spp2;
            $this->spp3 = $spp->spp3;
        }
    }

    public function save(): void
    {
        $this->validate();

        $tahunAjaran = $this->tahun_ajaran1 . '/' . $this->tahun_ajaran2;

        $cek = Spp::where('tahun_ajaran', $tahunAjaran)
            ->when($this->sppID, fn($q) => $q->where('id', '!=', $this->sppID))
            ->exists();

        if ($cek) {
            flash()->warning("Tahun Ajaran $tahunAjaran sudah ada. Silahkan coba lagi.");
            return;
        }

        Spp::updateOrCreate(
            ['id' => $this->sppID],
            [
                'tahun_ajaran1' => $this->tahun_ajaran1,
                'tahun_ajaran2' => $this->tahun_ajaran2,
                'tahun_ajaran'  => $tahunAjaran,
                'spp1' => $this->spp1,
                'spp2' => $this->spp2,
                'spp3' => $this->spp3,
            ]
        );

        flash()->success("Data SPP berhasil disimpan.");
        $this->reset();
        redirect('/spp');
    }

    public function render()
    {
        return view('livewire.form-spp');
    }
}

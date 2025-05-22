<?php

namespace App\View\Components;

use Closure;
use App\Models\User;
use App\Models\ClassRoom;
use App\Models\Configuration;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $angkatan = User::select('tahun_masuk')
            ->whereHas('roles', function ($query) {
                $query->where('name', 'Siswa');
            })
            ->distinct()
            ->orderBy('tahun_masuk', 'DESC')
            ->get()
            ->toArray();
        $class = ClassRoom::orderBy('name_class', 'ASC')->get();
        $config = Configuration::find(1);
        return view('layouts.sidebar', ['class' => $class, 'angkatan' => $angkatan, 'config' => $config]);
    }
}

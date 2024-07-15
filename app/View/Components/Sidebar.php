<?php

namespace App\View\Components;

use App\Models\ClassRoom;
use App\Models\Configuration;
use App\Models\Student;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

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
        $angkatan = Student::select('tahun_masuk')
            ->distinct()
            ->orderBy('tahun_masuk', 'DESC')
            ->get()
            ->toArray();
        $class = ClassRoom::orderBy('name_class', 'ASC')->get();
        $config = Configuration::find(1);
        return view('components.sidebar', ['class' => $class, 'angkatan' => $angkatan, 'config' => $config]);
    }
}

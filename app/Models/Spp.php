<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spp extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function get_spp($tahun_ajaran)
    {
        $spp = Spp::where('tahun_ajaran', $tahun_ajaran)->first();
        return $spp;
    }
}

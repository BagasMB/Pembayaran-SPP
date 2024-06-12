<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spp extends Model
{
    use HasFactory;
    protected $fillable = ['tahun_ajaran', 'spp1', 'spp2', 'spp3'];
}

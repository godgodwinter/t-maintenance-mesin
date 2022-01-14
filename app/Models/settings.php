<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class settings extends Model
{
    public $table = "settings";

    use HasFactory;

    protected $fillable = [
        'app_nama',
        'app_namapendek',
        'paginationjml',
        'lembaga_nama',
        'lembaga_jalan',
        'lembaga_telp',
        'lembaga_kota',
        'lembaga_logo',
        'wa_status',
        'wa_linkon',
        'wa_linkoff',
    ];
}

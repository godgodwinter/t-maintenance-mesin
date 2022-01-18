<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class gedung extends Model
{
        public $table = "gedung";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'nama',
            'lantai',
        ];

        // public function kriteria()
        // {
        //     return $this->hasMany('App\Models\kriteria');
        // }
}

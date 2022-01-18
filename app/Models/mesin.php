<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class mesin extends Model
{
        public $table = "mesin";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'nama',
            'kategori_id',
            'gedung_id',
        ];

        public function kategori()
        {
            return $this->hasMany('App\Models\kategori');
        }
        public function gedung()
        {
            return $this->hasMany('App\Models\gedung');
        }
}

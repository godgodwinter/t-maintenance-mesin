<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class pelaporankerusakan extends Model
{
        public $table = "pelaporankerusakan";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'pelaporankerusakan_id',
            'mesin_id',
            'keterangan',
        ];

        public function mesin()
        {
            return $this->hasMany('App\Models\mesin');
        }
        public function pelaporankerusakan()
        {
            return $this->hasMany('App\Models\pelaporankerusakan');
        }
}

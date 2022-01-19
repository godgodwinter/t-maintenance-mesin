<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class pelaporankerusakandetail extends Model
{
        public $table = "pelaporankerusakandetail";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'pelaporankerusakan_id',
            'mesin_id',
            'keterangan',
        ];

        public function mesin()
        {
            return $this->belongsTo('App\Models\mesin');
        }
        public function pelaporankerusakan()
        {
            return $this->belongsTo('App\Models\pelaporankerusakan');
        }
}

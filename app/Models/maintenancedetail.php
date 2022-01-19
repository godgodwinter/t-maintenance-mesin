<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class maintenancedetail extends Model
{
        public $table = "maintenancedetail";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'pelaporankerusakandetail_id',
            'maintenance_id',
            'mesin_id',
            'keterangan',
        ];

        public function mesin()
        {
            return $this->belongsTo('App\Models\mesin');
        }
        public function maintenance()
        {
            return $this->belongsTo('App\Models\maintenance');
        }
        public function pelaporankerusakandetail()
        {
            return $this->belongsTo('App\Models\pelaporankerusakandetail');
        }
}

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
            'maintenance_id',
            'mesin_id',
            'keterangan',
        ];

        public function mesin()
        {
            return $this->hasMany('App\Models\mesin');
        }
        public function maintenance()
        {
            return $this->hasMany('App\Models\maintenance');
        }
}

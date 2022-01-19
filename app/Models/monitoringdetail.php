<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class monitoringdetail extends Model
{
        public $table = "monitoringdetail";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'mesin_id',
            'monitoring_id',
            'keterangan',
        ];

        public function mesin()
        {
            return $this->belongsTo('App\Models\mesin');
        }
        public function monitoring()
        {
            return $this->belongsTo('App\Models\monitoring');
        }
}

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
            'tgl',
            'users_id',
        ];

        public function users()
        {
            return $this->belongsTo('App\Models\User');
        }
}

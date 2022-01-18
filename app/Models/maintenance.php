<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class maintenance extends Model
{
        public $table = "maintenance";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'tgl',
            'pelaporankerusakan_id',
            'users_id',
        ];

        public function users()
        {
            return $this->hasMany('App\Models\User');
        }
        public function pelaporankerusakan()
        {
            return $this->hasMany('App\Models\pelaporankerusakan');
        }
}

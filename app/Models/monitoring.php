<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class monitoring extends Model
{
        public $table = "monitoring";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'tgl',
            'users_id',
        ];

        public function users()
        {
            return $this->hasMany('App\Models\User');
        }
}

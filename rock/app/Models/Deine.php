<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deine extends Model {

    protected $table = 'deine';
    protected $fillable = [
        'pdf','created_at','updated_at'
    ];

    protected $primaryKey = 'p_id';
    public $timestamps = false;

}

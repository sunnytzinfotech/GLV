<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogData extends Model {

    protected $table = 'log_user';
    protected $fillable = [
        'user_id','stage','created_at','updated_at'
    ];

    protected $primaryKey = 'id';
    public $timestamps = false;

    public static function getAll() {
        return self::orderBy('updated_at', 'desc')->get();
    }

}

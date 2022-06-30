<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEmpfehlungCode extends Model {

    protected $table = 'user_empfehlung_code';
    protected $fillable = [
        'user_name','last_name','mr_mrs','dob','c_id', 'userid', 'code','time','used','popup_id','phone_code','created_at','updated_at','check_url'
    ];

    protected $primaryKey = 'c_id';
    public $timestamps = false;

}

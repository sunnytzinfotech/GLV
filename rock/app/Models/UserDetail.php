<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model {

    protected $table = 'user_detail';
    protected $fillable = [
        'unternehmen', 'strabe', 'plzort','geburtsdatum','ihkregister','beginndes','email2','iban','bankdetail','kontoinhaber','weitere','sonsge','user_id','frau1','distribution','distribution_status','confidentiality','confidentiality_status','avv_contract','avv_contract_status','updated_at','created_at','check_status'
    ];

    protected $primaryKey = 'id';
    public $timestamps = false;

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model {

    protected $table = 'faq';
    protected $fillable = [
        'title','text','status','created_at','updated_at'
    ];

    protected $primaryKey = 'id';
    public $timestamps = false;

}

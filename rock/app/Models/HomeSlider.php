<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSlider extends Model {

    protected $table = 'home_slider';
    protected $fillable = [
        'text_1', 'text_2', 'image','status','created_at','updated_at'
    ];

    protected $primaryKey = 'id';
    public $timestamps = false;

}

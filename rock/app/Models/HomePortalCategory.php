<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePortalCategory extends Model {

    protected $table = 'home_portal_category';
    protected $fillable = [
        'c_name', 'color', 'created_at', 'updated_at','c_image'
    ];

    protected $primaryKey = 'id';
    public $timestamps = false;

}

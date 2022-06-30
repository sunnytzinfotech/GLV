<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site_data extends Model
{
    public $timestamps=true;
    protected $dates = ['deleted_at'];

    protected $table = 'site_data';

    protected $primaryKey = 'action'; // or null

    public $incrementing = false;

    protected $hidden = array('password', 'remember_token');

    protected $fillable = ['id', 'action', 'page_name','description','updated_at','deleted_at'];
}

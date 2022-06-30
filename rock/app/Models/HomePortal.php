<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePortal extends Model {

    protected $table = 'home_portal';
    protected $fillable = [
        'logo', 'title', 'decription','price','sub_price','color','model','b_btn_text','b_btn_text_2','b_btn_text_3','b_btn_url','g_btn_text','g_btn_text_2','g_btn_text_3','g_btn_url','btn_iframe','m_description','check_internal_frame','check_verify','created_at','updated_at','deleted_at','category_id','special_tipps','document','active',
    ];

    protected $primaryKey = 'id';
    public $timestamps = false;

}

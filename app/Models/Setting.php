<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'site_name',
        'description',
        'about',
        'copy_rights',
        'contact_email',
        'url_fb',
        'url_insta',
        'url_twitter',
        'url_linkedin'
    ];
}

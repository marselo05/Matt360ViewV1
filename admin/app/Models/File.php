<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'url_size_1',
        'url_size_2',
        'state',
    ];
    // Relacion uno a muchos

    public function user() {
    	return $this->belongsTo('App\Models\User'); 
    }

    public function tag() {
        return $this->belongsTo('App\Models\Tag');
    }
}

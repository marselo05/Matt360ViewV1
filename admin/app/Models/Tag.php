<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

	protected $fillable = ['name', 'state'];

    // Relacion uno a muchos
    public function files() {
        return $this->hasMany('App\Models\File');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = ['user_id', 'name', 'value'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

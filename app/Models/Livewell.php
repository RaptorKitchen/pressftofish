<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livewell extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var integer
     */
    protected $primaryKey = 'livewell_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'player_id',
        'maximum',
        'livewell_json'
    ];
}

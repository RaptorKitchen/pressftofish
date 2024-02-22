<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fish extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'fish_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'latin_name',
        'chance_range_start',
        'chance_range_end',
        'active_time_of_day_start',
        'active_time_of_day_end',
        'population',
        'season',
        'description',
        'image_url'
    ];
}

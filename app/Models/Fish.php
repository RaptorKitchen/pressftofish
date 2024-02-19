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
     * @var integer
     */
    protected $primaryKey = 'fish_id';

    /**
    * @var string
    */
    protected $name = 'name';

    /**
    * @var string
    */
    protected $latinName = 'latin_name';

    /**
    * @var string
    */
   protected $chanceRange = 'chance_range';

    /**
    * @var string
    */
    protected $activeTimeOfDay = 'active_time_of_day';

    /**
    * @var integer
    */
    protected $population = 'population';

    /**
    * @var string
    */
    protected $season = 'season';

    /**
    * @var string
    */
    protected $description = 'description';
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var integer
     */
    protected $primaryKey = 'player_id';

    /**
     *
     * @var integer
     */
    protected $userId = 'user_id';

     /**
     *
     * @var integer
     */
    protected $strength = 'strength';

     /**
     *
     * @var integer
     */
    protected $dexterity = 'dexterity';

     /**
     *
     * @var integer
     */
    protected $constitution = 'constitution';

     /**
     *
     * @var integer
     */
    protected $intelligence = 'intelligence';

     /**
     *
     * @var integer
     */
    protected $wisdom = 'wisdom';

     /**
     *
     * @var integer
     */
    protected $charisma = 'charisma';

     /**
     *
     * @var integer
     */
    protected $conformity = 'conformity';
}

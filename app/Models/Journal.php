<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var integer
     */
    protected $primaryKey = 'journal_id';

    /**
     *
     * @var integer
     */
    protected $playerId = 'player_id';

    /**
     *
     * @var string
     */
    protected $journalJson = 'journal_json';
}

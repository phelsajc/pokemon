<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "pokemon";

    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'pokemon', 'created_by', 'created_dt','isfav',
    ];
}



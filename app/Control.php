<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Control extends Model
{
    protected $table = 'controls';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['butacas'];
}

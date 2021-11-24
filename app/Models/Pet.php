<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pet extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    use SoftDeletes;

	protected $table = 'pets';
	public $timestamps = true;

    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'nickname', 'weight', 'height', 'gender', 'color', 'friendliness', 'birthday'];
}

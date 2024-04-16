<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'p_number', 'description', 'status' // Add other attributes here as needed
    ];

    public function policy()
    {
        return $this->belongsTo(Policy::class, 'p_number', 'p_number');
    }
}

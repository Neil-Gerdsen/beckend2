<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spel extends Model
{
    protected $table = 'Spellen';

     protected $fillable = [
        'ronde_id',
        'is_active',
        'user_id',
        'created_at',
        'updated_at'
    ];


      public function game()
    {
        return $this->belongsTo(Zetten::class);
    }
    public function player()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zetten extends Model
{
    use HasFactory;

    protected $table = 'Zetten';
    protected $fillable = [
        'id',
        'ronde_id',
        'player_x_id',
        'player_o_id',
        'rij',
        'kolom',
        'current_turn',
        'created_at',
        'updated_at'
    ];
      public function playerX()
    {
        return $this->belongsTo(User::class, 'player_x_id');
    }

    public function playerO()
    {
        return $this->belongsTo(User::class, 'player_o_id');
    }
    public function rounds()
    {
        return $this->hasMany(Spel::class);
    }
}

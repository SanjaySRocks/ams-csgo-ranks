<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class LevelRanksWeapons extends Model
{
    use HasFactory;

    protected $table = "lvl_base_weapons";

    public function user(){
        return $this->belongsTo(LevelRanks::class, 'steam', 'steam');
    }
}

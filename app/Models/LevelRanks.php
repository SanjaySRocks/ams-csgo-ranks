<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelRanks extends Model
{
    use HasFactory;

    protected $table = "lvl_base";

    public function weapons()
    {
        return $this->hasMany(LevelRanksWeapons::class, 'steam', 'steam');
    }

    public function base_hits()
    {
        return $this->hasOne(LevelRanksHits::class, 'SteamID', 'steam');
    }

    public function maps()
    {
        return $this->hasMany(LevelRanksMaps::class, 'steam', 'steam');
    }

    public function unusual()
    {
        return $this->hasMany(LevelRanksUnusual::class, 'SteamID', 'steam');
    }
}

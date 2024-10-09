<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weeks extends Model
{
    use HasFactory;

    protected $table = 'weeks';

    public static function getRecords()
    {
        return self::get();
    }

    public static function getWeekUsingName(string $weekName)
    {
        return self::where('name', $weekName)->first();
    }
}

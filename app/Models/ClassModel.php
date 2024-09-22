<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'class';

    public static function getSingle($id)
    {
        return self::find($id);
    }

    public static function getRecords()
    {
        $query = self::select('class.*', 'users.name as created_by_name')
            ->join('users', 'users.id', 'class.created_by')
            ->where('class.is_delete', 0);
        if (!empty(Request::get('name'))) {
            $query = $query->where('class.name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('date'))) {
            $query = $query->whereDate('class.created_at', '=', Request::get('date'));
        }
        $query = $query->orderBy('class.id', 'desc')
            ->paginate(20);


        return $query;
    }

    public static function getClass()
    {
        $query = self::select('class.*')
            ->join('users', 'users.id', 'class.created_by')
            ->where('class.is_delete', 0)
            ->where('class.status', 0)
            ->orderBy('class.name', 'asc')
            ->get();


        return $query;
    }
}

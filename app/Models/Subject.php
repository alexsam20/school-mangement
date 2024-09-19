<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subjects';

    public static function getSingle($id)
    {
        return self::find($id);
    }

    public static function getRecords()
    {
        $query = self::select('subjects.*', 'users.name as created_by_name')
            ->join('users', 'users.id', 'subjects.created_by')
            ->where('subjects.is_delete', 0);
        if (!empty(Request::get('name'))) {
            $query = $query->where('subjects.name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('type'))) {
            $query = $query->where('subjects.type', Request::get('type'));
        }
        if (!empty(Request::get('date'))) {
            $query = $query->whereDate('subjects.created_at', Request::get('date'));
        }
        $query = $query->orderBy('subjects.id', 'desc')
            ->paginate(20);


        return $query;
    }
}

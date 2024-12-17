<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoticeBoardsMessage extends Model
{
    use HasFactory;

    protected $table = 'notice_boards_messages';

    public static function deleteRecord($id)
    {
        self::where('notice_board_id', $id)->delete();
    }
}

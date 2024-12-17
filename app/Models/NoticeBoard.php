<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class NoticeBoard extends Model
{
    use HasFactory;

    protected $table = 'notice_boards';

    public static function getSingle($id)
    {
        return self::find($id);
    }

    public static function getRecords()
    {
        $records = self::select('notice_boards.*', 'users.name as created_by_name')
            ->join('users', 'users.id', 'notice_boards.created_by');
        if (!empty(Request::get('title'))) {
            $records = $records->where('notice_boards.title', 'like', '%' . trim(Request::get('title')) . '%');
        }
        if (!empty(Request::get('notice_date_from'))) {
            $records = $records->where('notice_boards.notice_date', '>=', Request::get('notice_date_from'));
        }
        if (!empty(Request::get('notice_date_to'))) {
            $records = $records->where('notice_boards.notice_date', '<=', Request::get('notice_date_to'));
        }
        if (!empty(Request::get('publish_date_from'))) {
            $records = $records->where('notice_boards.publish_date', '>=', Request::get('publish_date_from'));
        }
        if (!empty(Request::get('publish_date_to'))) {
            $records = $records->where('notice_boards.publish_date', '<=', Request::get('publish_date_to'));
        }
        if (!empty(Request::get('message_to'))) {
            $records = $records->join('notice_boards_messages', 'notice_boards_messages.notice_board_id', 'notice_boards.id');
            $records = $records->where('notice_boards_messages.message_to', Request::get('message_to'));
        }
        $records = $records->orderBy('notice_boards.id', 'desc')
            ->paginate(20);

        return $records;
    }

    public function getMessage()
    {
        return $this->hasMany(NoticeBoardsMessage::class, 'notice_board_id');
    }

    public function getMessageToSingle($noticeBoardId, $messageTo)
    {
        return NoticeBoardsMessage::where('notice_board_id', $noticeBoardId)
            ->where('message_to', $messageTo)->first();
    }
}

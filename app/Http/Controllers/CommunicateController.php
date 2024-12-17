<?php

namespace App\Http\Controllers;

use App\Models\NoticeBoard;
use App\Models\NoticeBoardsMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunicateController extends Controller
{
    public function noticeBoard()
    {
        $data['getRecords'] = NoticeBoard::getRecords();
        $data['header_title'] = 'Notice Board - ';
        return view('admin.communicate.noticeboard.list', $data);
    }
    public function addNoticeBoard()
    {
        $data['header_title'] = 'Add New Notice Board - ';
        return view('admin.communicate.noticeboard.add', $data);
    }

    public function insertNoticeBoard(Request $request)
    {
        $noticeBoard = new NoticeBoard();
        $noticeBoard->title = $request->title;
        $noticeBoard->notice_date = $request->notice_date;
        $noticeBoard->publish_date = $request->publish_date;
        $noticeBoard->message = $request->message;
        $noticeBoard->created_by = Auth::user()->id;
        $noticeBoard->save();

        if (!empty($request->message_to)) {
            foreach ($request->message_to as $messageTo) {
                $message = new NoticeBoardsMessage();
                $message->notice_board_id = $noticeBoard->id;
                $message->message_to = $messageTo;
                $message->save();
            }
        }

        return redirect('admin/communicate/notice_board')->with('success', 'Notice Board successfully created');
    }

    public function editNoticeBoard($id)
    {
        $data['getRecord'] = NoticeBoard::getSingle($id);
        $data['header_title'] = 'Edit Notice Board - ';
        return view('admin.communicate.noticeboard.edit', $data);
    }

    public function updateNoticeBoard($id, Request $request)
    {
        $noticeBoard = NoticeBoard::getSingle($id);
        $noticeBoard->title = $request->title;
        $noticeBoard->notice_date = $request->notice_date;
        $noticeBoard->publish_date = $request->publish_date;
        $noticeBoard->message = $request->message;
        $noticeBoard->save();

        NoticeBoardsMessage::deleteRecord($id);

        if (!empty($request->message_to)) {
            foreach ($request->message_to as $messageTo) {
                $message = new NoticeBoardsMessage();
                $message->notice_board_id = $noticeBoard->id;
                $message->message_to = $messageTo;
                $message->save();
            }
        }

        return redirect('admin/communicate/notice_board')->with('success', 'Notice Board successfully updated');
    }

    public function deleteNoticeBoard($id)
    {
        $noticeBoard = NoticeBoard::getSingle($id);
        $noticeBoard->delete();
        NoticeBoardsMessage::deleteRecord($id);

        return redirect()->back()->with('success', 'Notice Board successfully deleted');
    }
}

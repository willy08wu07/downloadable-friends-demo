<?php

namespace App\Http\Controllers;

use App\Events\ChatMessagePosted;
use App\Models\ChatMessage;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Http\Request;

class ChatMessagesController extends Controller
{
    public function getChatRoomPage()
    {
        return view('chat-room');
    }

    public function getMessages(): CursorPaginator
    {
        return ChatMessage::orderBy('id', 'desc')->cursorPaginate(100);
    }

    public function postNewMessage(Request $request)
    {
        $request->merge([
            'lang' => $request->getPreferredLanguage(),
        ]);
        $params = $this->validate($request, [
            // 為了讓使用者可以使用中文名稱，暫時不對名稱格式設限
            'author_name' => 'required|string|between:1,20',
            'message' => 'required|string|between:1,100',
            'lang' => 'required|string|between:1,20',
        ]);
        $chatMessage = ChatMessage::create($params);
        broadcast(new ChatMessagePosted($chatMessage))->toOthers();
        return response([
            'data' => $chatMessage,
        ]);
    }
}

<?php

namespace App\Http\Repositories;

use App\Models\Chat;

class ChatRepository
{

    public function store($request)
    {
        $chat = new Chat;

        $chat->message = $request->message;
        $chat->user_id = $request->user()->id;

        $chat->save();
    }

}

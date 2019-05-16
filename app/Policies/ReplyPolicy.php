<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reply;

class ReplyPolicy extends Policy
{
    public function destroy(User $user, Reply $reply)
    {
        return \Illuminate\Support\Facades\Auth::guard('api')->user();

        return $user->id == $reply->user_id || $user->id == $reply->topic->user_id;
    }
}

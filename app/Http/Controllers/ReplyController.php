<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyRequest;
use App\Models\Guide;
use App\Models\Reply;
use App\Models\User;
use App\Transformers\ReplyTransformer;
use Illuminate\Http\Request;

class ReplyController extends BaseController
{
    //发布回复
    public function store(ReplyRequest $request, Guide $guide, Reply $reply)
    {
        $reply->content = request('content');
        $reply->guide_id = $guide->id;
        $reply->user_id = $this->user()->id;
        $reply->save();

        return $this->response->item($reply, new ReplyTransformer())
            ->setStatusCode(201);
    }

    //删除回复
    public function destroy(Guide $guide, Reply $reply)
    {
        if ($reply->guide_id != $guide->id) {
            return $this->response->errorBadRequest();
        }

//        $this->authorize('destroy', $reply);
        $reply->delete();

        return $this->response->noContent();
    }
    //评论列表
    public function index(Guide $guide)
    {
        $replies = $guide->replies()->paginate(20);

        return $this->response->paginator($replies, new ReplyTransformer());
    }

    //某个用户的回复列表
    public function userIndex(User $user)
    {
        $replies = $user->replies()->paginate(20);

        return $this->response->paginator($replies, new ReplyTransformer());
    }


}

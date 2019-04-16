<?php
namespace App\Transformers;
use App\Models\Reply;
use League\Fractal\TransformerAbstract;

class ReplyTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['user','guide'];

    public function transform(Reply $reply)
    {
        return [
            'id' => $reply->id??'',
            'guide_id'=>(int) $reply->guide_id??'',
            'content'=> $reply->content??'',
            'user_id'=>(int) $reply->user_id??'',
            'reply_pre'=>$reply->reply_pre??'',
            'created_at'=>$reply ->created_at?$reply->created_at->toDateTimeString():'',
            'updated_at' => $reply->updated_at?$reply->updated_at->toDateTimeString():'',
        ];
    }

    public function includeUser(Reply $reply)
    {
        return $this->item($reply->user, new UserTransformer());
    }

    public function includeGuide(Reply $reply)
    {
        return $this->item($reply->guide, new GuideTransformer());
    }


}

<?php
namespace App\Transformers;
use App\Models\Reply;
use Leagu\Fractal\TransformerAbstract;

class ReplyTransformer extends TransformerAbstract
{
    public function transform(Reply $reply)
    {
        return [
            'id' => $reply->id??'',
            'guide_id'=> $reply->guide_id??'',
            'content'=> $reply->content??'',
            'user_id'=>$reply->user_id??'',
            'reply_pre'=>$reply->reply_pre??'',
            'created_at'=>$reply ->created_at?$reply->created_at->toDateTimeString():'',
        ];
    }
}

<?php
namespace App\Transformers;
use App\Models\Guide;
use League\Fractal\TransformerAbstract;

class GuideTransformer extends TransformerAbstract
{
    public function transform(Guide $guide)
    {
        return [
            'id' => $guide->id??'',
            'title'=> $guide->title??'',
            'body'=> $guide->body??'',
            'user_id'=>$guide->user_id??'',
            'gender'=>$guide->gender??'',
            'reply_count'=>$guide->reply_count??0,
            'view_count'=>$guide->view_count??0,
            'created_at'=>$guide ->created_at?$guide->created_at->toDateTimeString():'',
        ];
    }
}

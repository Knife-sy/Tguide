<?php
namespace App\Transformers;
use App\Models\Guide;
use League\Fractal\TransformerAbstract;

class GuideTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['user'];

    public function transform(Guide $guide)
    {
        return [
            'id' => $guide->id??'',
            'title'=> $guide->title??'',
            'body'=> $guide->body??'',
            'user_id'=>(int)$guide->user_id??'',
            'reply_count'=>(int)$guide->reply_count??0,
            'view_count'=>(int)$guide->view_count??0,
            'created_at'=>$guide ->created_at?$guide->created_at->toDateTimeString():'',
            'updated_at' =>$guide->updated_at? $guide->updated_at->toDateTimeString():'',
        ];
    }

    public function includeUser(Guide $guide)
    {
        return $this->item($guide->user, new UserTransformer());
    }
}

<?php
namespace App\Transformers;
use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'id' => $user->id??'',
            'name'=> $user->name??'',
            'email'=> $user->email??'',
            'introduction'=>$user->introduction??'',
            'gender'=>$user->gender??'',
            'constellation'=>$user->constellation??'',
            'hobby'=>$user->hobby??'',
            'area'=>$user->area??'',
            'phone'=>$user->phone??'',
            'created_at'=>$user ->created_at?$user->created_at->toDateTimeString():'',
        ];
    }
}

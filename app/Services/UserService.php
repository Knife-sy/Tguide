<?php
namespace App\Services;

use App\Models\User;

class UserService
{
    //注册
    public function add()
    {
        $postData = request()->post();
        $user = new User();
        $user->fill($postData);
        $user->password = bcrypt(request('password'));
        $user->save();
        return $user ->id;
    }
    

}

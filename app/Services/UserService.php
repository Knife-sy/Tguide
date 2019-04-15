<?php
namespace App\Services;

class UserService
{
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

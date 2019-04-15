<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //用户列表
    public function index(Request $request){

        $get = $request->all();
        $user = User::filter($get);
        return $this->response()->Array($user, new UserTransformer());
    }

    public function add(UserRequest $request, User $user, UserService $userService){
        $id = $userService ->add();
        if(!$id){
            $this->response() ->error($userService ->errorMsg);
        }
        $this->response() ->array([
            'id'=>$id,
        ]);
    }

    // 修改
    public function edit(UserRequest $request,User $user, UserService $userService)
    {
        $id = $userService->edit();
        if (!$id) {
            $this->response()->error($userService->errorMsg);
        }
        $this->response()->array([
            'id' => $id
        ]);

    }

}

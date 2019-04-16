<?php
namespace App\Http\Controllers;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use App\Models\Image;


class UserController extends BaseController
{
    public function __construct()
    {
//        $this->middleware('auth', [
//            'except' => ['index','store']
//        ]);
    }
    //用户列表
    public function index(Request $request)
    {
        $get = $request->all();
        $user = User::where('is_admin',0)->get();
        return $this->response->collection($user, new UserTransformer);
    }

    //添加用户
    public function store(UserRequest $request, User $user, UserService $userService)
    {
        $id = $userService->add();
        if (!$id) {
            return $this->response()->error('注册失败');
        }
        return $this->response->item($user, new UserTransformer())
            ->setMeta([
                'access_token' => \Auth::guard('api')->fromUser($user),
                'token_type' => 'Bearer',
                'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60
            ])
            ->setStatusCode(201);
    }

    public function me()
    {
        return $this->response->item($this->user(), new UserTransformer());
    }

    //编辑
    public function update(UserRequest $request)
    {
        $user = $this->user();
        //$this->authorize('update', $user);

        $attributes = $request->only(['name', 'introduction', 'gender', 'constellation',
            'hobby', 'area', 'phone']);

        if ($request->avatar_image_id) {
            $image = Image::find($request->avatar_image_id);

            $attributes['avatar'] = $image->path;
        }
        $user->update($attributes);

        return $this->response->item($user, new UserTransformer());
    }

    public function destroy( User $user)
    {
        //$this->authorize('destroy', $user);

        $user->delete();
        return $this->response->noContent();
    }

}


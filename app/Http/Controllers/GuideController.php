<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuideRequest;
use App\Models\Guide;
use App\Models\User;
use App\Transformers\GuideTransformer;
use Illuminate\Http\Request;

class GuideController extends BaseController
{
    //发布攻略
    public function store(GuideRequest $request, Guide $guide)
    {
        $guide->fill($request->all());
        $guide->user_id = $this->user()->id;
        $guide->save();

        return $this->response->item($guide, new GuideTransformer())
            ->setStatusCode(201);
    }

    //修改攻略
    public function update(GuideRequest $request, Guide $guide)
    {
       $guide->update($request->all());
        return $this->response->item($guide, new GuideTransformer());
    }

    //删除攻略
    public function destroy( Guide $guide)
    {
        //$this->authorize('destroy', $user);

        $guide->delete();
        return $this->response->noContent();
    }

    //攻略列表
    public function index(Request $request, Guide $guide)
    {
        $query = $guide->query();

//        // 为了说明 N+1问题，不使用 scopeWithOrder
//        switch ($request->order) {
//            case 'recent':
//                $query->recent();
//                break;
//
//            default:
//                $query->recentReplied();
//                break;
//        }

        $guides = $query->paginate(20);

        return $this->response->paginator($guides, new GuideTransformer());
    }

    //某个用户的发布的攻略
    public function userIndex(User $user, Request $request)
    {
        $guides = $user->guides()
//            ->recent()
            ->paginate(20);

        return $this->response->paginator($guides, new GuideTransformer());
    }

    //攻略详情
    public function show(Guide $guide)
    {
        return $this->response->item($guide, new GuideTransformer());
    }




}

<?php
/**
 * Created by PhpStorm.
 * User: ying
 * Date: 2019/4/16
 * Time: 16:36
 */

namespace App\Transformers;


use App\Models\Role;
use League\Fractal\TransformerAbstract;

class RoleTransformer extends TransformerAbstract
{
    public function transform(Role $role)
    {
        return [
            'id' => $role->id,
            'name' => $role->name,
        ];
    }
}

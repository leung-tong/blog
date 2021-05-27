<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = "users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'phone','username', 'email', 'password','token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    // 根据条件获取菜单列表
    public function getList($params)
    {
        $sql = self::query();

        if (!empty($params['where'])) {
            $sql->where($params['where']);
        }

        $offset = ($params['page'] - 1) * $params['pagesize'];
        return $sql->offset($offset)->limit($params['pagesize'])->get()->toArray();
    }

    // 根据条件获取菜单列表总数
    public function getCount($where)
    {
        $sql = self::query();
        if (empty($params['where'])) {
            $sql->where($where);
        }
        return $sql->count();
    }

    // 根据Id更新
    public function updateRole($params)
    {
        return self::query()->where('id', $params['id'])->update($params);
    }

    // 根据id软删除菜单
    public function deleteById($id)
    {
        return self::query()->whereIn('id',$id)->delete();
    }

}

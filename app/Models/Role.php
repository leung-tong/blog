<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $table = "roles";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

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

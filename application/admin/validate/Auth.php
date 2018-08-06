<?php

/// +----------------------------------------------------------------------
// | 99PHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2018~2020 https://www.99php.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Mr.Chung <chung@99php.cn >
// +----------------------------------------------------------------------

namespace app\admin\validate;


use think\Validate;

class Auth extends Validate {

    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'id'      => 'require|number|checkAuthId',
        'title'   => 'require|max:30',
        'sort'    => 'member',
        'remark'  => 'require|max:250',
        'auth_id' => 'require',
        'node_id' => 'require',
        'field'   => 'require',
        'value'   => 'require|max:30',
    ];

    /**
     * 错误提示
     * @var array
     */
    protected $message = [
        'id.require'    => '编号必须',
        'title.require' => '角色权限必须',
        'id.number'     => '编号为数字',
        'field.require' => '字段必须',
        'value.require' => '修改值必须',
        'value.max'     => '修改值最多不能超过30个字符',
        'title.max'     => '权限角色名称最多不能超过30个字符',
    ];

    /**
     * 应用场景
     * @var array
     */
    protected $scene = [
        //添加系统角色
        'add'        => ['title'],

        //授权
        'authorize'  => ['auth_id, node_id'],

        //修改系统角色字段值
        'edit_field' => ['id', 'field', 'value'],

        //删除角色
        'del'        => ['id'],

        //更改角色状态
        'status'     => ['id'],
    ];

    /**
     * 自定义验证场景
     * @return Node
     */
    public function sceneEdit() {
        return $this->only(['id', 'remark', 'title'])
            ->remove('id', 'checkAuthId');
    }

    /**
     * 检测ID是否存在
     * @param $value
     * @param $rule
     * @param array $data
     * @return bool|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    protected function checkAuthId($value, $rule, $data = []) {
        $user = \app\admin\model\Auth::where(['id' => $value])->find();
        if (empty($user)) return '暂无角色数据，请稍后再试！';
        return true;
    }
}
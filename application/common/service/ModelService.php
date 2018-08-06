<?php
// +----------------------------------------------------------------------
// | 99PHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2018~2020 https://www.99php.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Mr.Chung <chung@99php.cn >
// +----------------------------------------------------------------------

namespace app\common\service;


use think\Model;

/**
 * 模型基础数据服务
 * Class ModelService
 * @package service
 */
class ModelService extends Model {

    /**
     * 主键定义
     * @var string
     */
    protected $pk = 'id';

    /**
     * 软删除操作
     * @param $id 列ID
     * @param bool $type 删除类型 （false:软删除，true:真实删除）
     * @return bool|ModelService
     * @throws \Exception
     */
    public function del($id, $type = false) {
        if ($type) {
            $del = $this->where('id', $id)->delete();
        } else {
            $del = $this->where('id', $id)->update(['is_deleted' => 1]);
        }
        if ($del >= 1) return __success('删除成功');
        return __error('删除失败，请检查！');
    }
}
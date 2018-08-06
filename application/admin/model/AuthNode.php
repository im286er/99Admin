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

namespace app\admin\model;


use app\common\service\ModelService;

class AuthNode extends ModelService {

    /**
     * 绑定的数据表
     * @var string
     */
    protected $table = 'system_auth_node';

    /**
     * 保存授权信息
     * @param $insertAll
     * @return \think\response\Json
     * @throws \Exception
     */
    public function authorize($insertAll) {
        $save = $this->saveAll($insertAll);
        if (!empty($save)) return __success('保存成功！');
        return __error('保存失败');
    }
}
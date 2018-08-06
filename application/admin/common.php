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

/**
 * 后台公共文件
 */

if (!function_exists('__success')) {

    /**
     * 成功时返回的信息
     * @param $msg 消息
     * @return \think\response\Json
     */
    function __success($msg) {
        return json(['code' => 0, 'msg' => $msg]);
    }
}

if (!function_exists('__error')) {

    /**
     * 错误时返回的信息
     * @param $msg 消息
     * @return \think\response\Json
     */
    function __error($msg) {
        return json(['code' => 1, 'msg' => $msg]);
    }
}
if (!function_exists('__log')) {

    /**
     * 写入系统日志
     * @param $data 数据
     * @param $type 日志类型
     */
    function __log($data, $type) {
        app('Log')::write(json_encode($data, JSON_UNESCAPED_UNICODE), $type);
    }
}

if (!function_exists('replace_menu_title')) {

    /**
     * 格式化菜单名称进行输出
     * @param $var 变量名
     * @param int $number 循环次数
     * @return string
     */
    function replace_menu_title($var, $number = 1) {
        $prefix = '';
        for ($i = 1; $i < $number; $i++) {
            $prefix .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;├ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        }
        return $prefix . $var;
    }
}
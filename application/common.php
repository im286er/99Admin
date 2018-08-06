<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

use app\common\service\NodeService;
use think\Request;
use app\common\service\AuthService;
use think\facade\Cache;

if (!function_exists('check_login')) {

    /**
     * 检测前端用户是否登录
     */
    function check_login() {
        if (empty(session('user'))) {
            return false;
        } else {
            return true;
        }
    }
}

if (!function_exists('auth')) {

    /**
     * 权限节点判断
     * @param $node 节点
     * @return bool （true：有权限，false：无权限）
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    function auth($node) {
        return AuthService::checkNode($node);
    }
}

if (!function_exists('parseNodeStr')) {

    /**
     * 驼峰转下划线规则
     * @param string $node
     * @return string
     */
    function parseNodeStr($node) {
        $tmp = [];
        foreach (explode('/', $node) as $name) {
            $tmp[] = strtolower(trim(preg_replace("/[A-Z]/", "_\\0", $name), "_"));
        }
        return trim(join('/', $tmp), '/');
    }
}

if (!function_exists('password')) {

    /**
     * 密码加密算法
     * @param $value 需要加密的值
     * @param $type  加密类型，默认为md5 （md5, hash）
     * @return mixed
     */
    function password($value) {
        $value = sha1('blog_') . md5($value) . md5('_encrypt') . sha1($value);
        return sha1($value);
    }

}

if (!function_exists('__buildData')) {

    /**
     * 构建数据
     * @param $data   模型数据
     * @param $method 模型方法
     */
    function __buildData(&$data, $method) {
        foreach ($data as &$vo) {
            $vo->$method;
        }
    }
}

if (!function_exists('alert')) {

    /**
     * 弹出层提示
     * @param string $msg  提示信息
     * @param string $url  跳转链接
     * @param int    $time 停留时间 默认2秒
     * @param int    $icon 提示图标
     * @return string
     */
    function alert($msg = '', $url = '', $time = 3, $icon = 6) {
        $success = '<meta name="renderer" content="webkit">';
        $success .= '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">';
        $success .= '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">';
        $success .= '<script type="text/javascript" src="/static/plugs/jquery/jquery-2.2.4.min.js"></script>';
        $success .= '<script type="text/javascript" src="/static/plugs/layui-layer/layer.js"></script>';
        if (empty($url)) {
            $success .= '<script>$(function(){layer.msg("' . $msg . '", {icon: ' . $icon . ', time: ' . ($time * 1000) . '});})</script>';
        } else {
            $success .= '<script>$(function(){layer.msg("' . $msg . '",{icon:' . $icon . ',time:' . ($time * 1000) . '});setTimeout(function(){self.location.href="' . $url . '"},2000)});</script>';
        }
        return $success;
    }
}

if (!function_exists('msg_success')) {

    /**
     * 成功时弹出层提示信息
     * @param string $msg  提示信息
     * @param string $url  跳转链接
     * @param int    $time 停留时间 默认2秒
     * @param int    $icon 提示图标
     * @return string
     */
    function msg_success($msg = '', $url = '', $time = 3, $icon = 1) {
        return alert($msg, $url, $time, $icon);
    }
}

if (!function_exists('msg_error')) {

    /**
     * 失败时弹出层提示信息
     * @param string $msg  提示信息
     * @param string $url  跳转链接
     * @param int    $time 停留时间 默认2秒
     * @param int    $icon 提示图标
     * @return string
     */
    function msg_error($msg = '', $url = '', $time = 3, $icon = 2) {
        return alert($msg, $url, $time, $icon);
    }
}

if (!function_exists('clear_menu')) {

    /**
     * 清空菜单缓存
     */
    function clear_menu() {
        Cache::clear('menu');
    }
}


if (!function_exists('clear_basic')) {

    /**
     * 清空菜单缓存
     */
    function clear_basic() {
        Cache::clear('basic');
    }
}

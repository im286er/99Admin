<?php

namespace app\index\controller;


use think\Controller;

class Index extends Controller {

    /**
     * 网站首页
     * @return mixed
     */
    public function index() {
		echo '欢迎使用99Admin后台管理系统';
    }
}

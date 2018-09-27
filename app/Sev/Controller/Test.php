<?php
/**
 * Created by PhpStorm.
 * User: wangyifeng
 * Date: 2018/5/22
 * Time: 下午6:54
 */
namespace app\Sev\Controller;

use app\Logic\TestModel;
use \Vendor\Power\View\View;

class Test
{
    public function index($request)
    {

//        $view = new \View($this);
//        $test = 'test view var';
//
//        $view->display();

        $tpl = new view();
        $tpl->assign('name', '王一峰');
        $data = array(
            'wangyifeng' => 'baipang',
            'test1' => 'value1',
            'test2' => 'value2',
        );
        $tpl->assign('data', $data);
        $tpl->assign('name', 'wanth');
        $tpl->show('member');
//        include "/data/webroot/www.baipang.cn/cache/aa08769cdcb26674c6706093503ff0a3.php";

        //Warning 既然写框架所有的细节都应该让自己来写。而不是composer一个库。如果纯composer的话。几乎不用自己写东西了。
//        $templates = new \League\Plates\Engine('app/Sev/View');
//        $templates->addData(['company' => 'The Company Name'], 'layout');
//
//        echo $templates->render('index', ['name' => 'Jonathan']);
    }

    public static function who()
    {
       echo __METHOD__;

    }

    public static function what()
    {
        static::who();
//        echo __CLASS__;
    }
}

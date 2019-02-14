<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/19
 * Time: 10:27
 */

namespace app\home\controller;
use app\index\model\Article as ArticleModel;
use app\home\controller\Base;
use think\Request;
use app\home\controller\Goods;
use think\Session;

class Article extends Base
{
        public function byid(Request $request){
            $id=$request->param("id");
            $data=ArticleModel::get($id);

            $comdata=$this->comdata();

            $goodamodel=new Goods();
            $discount=$goodamodel->order_by("discount");
            $this->view->assign($comdata);
            $this->assign([
                "data"=>$data,
                "discount"=>$discount,
            ]);

            return $this->fetch("index/article");

        }
}
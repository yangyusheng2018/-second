<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/16
 * Time: 9:51
 */

namespace app\index\controller;

use app\index\controller\Base;
use app\index\model\Article as ArticleModel;
use think\Request;

class Article extends Base
{
    public function add_article(Request $request){
        $data=$this->request->param();
        $data["create_time"]=strtotime( $data["create_time"]);
        $data["content"]= $data["editorValue"];
        unset($data["editorValue"]);
        if(ArticleModel::create($data)) {
            $status = 1;
            $messages = "已添加";
        }else{
            $status=0;
            $messages="添加失败";
        }
        return ['status'=>$status,'message'=>$messages];
    }
    public function article_list(){
        $controllers=strtolower($this->getc());
        $models=$this->getm();
        $data=$models::all();
        $count=count($data);
        if($controllers=="Brand"){
            $title="品牌列表";
        }elseif ($controllers=="Member"){
            $title="会员列表";
        }elseif ($controllers=="Goods"){
            $title="商品列表";
        }else{
            $title="未定义";
        }

        $this->view->assign("title",$title);
        $this->view->assign("data",$data);
        $this->view->assign("count",$count);
        return $this->view->fetch($controllers."_list");
    }
    public function edit_article(Request $request){
        $data=$this->request->param();
        $data["create_time"]=strtotime( $data["create_time"]);
        $data["content"]= $data["editorValue"];
        unset($data["editorValue"]);
        if(ArticleModel::update($data,["id"=>$data["id"]])) {
            $status = 1;
            $messages = "已修改";
        }else{
            $status=0;
            $messages="修改失败";
        }
        return ['status'=>$status,'message'=>$messages];
    }
}
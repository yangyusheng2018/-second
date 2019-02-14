<?php
/**
 * Created by PhpStorm.
 * User: yang
 * Date: 2018/8/15
 * Time: 23:53
 */

namespace app\index\controller;


use think\Controller;
use think\Session;
use think\Request;
class Base extends Controller
{
    public function _initialize()
    {
        if(!session('user_id')){
            $this->error("用户未登录",url("/index/login/login"));
        }
    }


    //删除功能

    public function getc(){
        $controllers=request()->controller();
        return $controllers;
    }
    public function getm(){
        $controllers=request()->controller();
        $models='\\app\\index\\model\\'.$controllers;
        return $models;
    }
    public function alllist(){
        $controllers=$this->getc();
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

    public function delete(Request $request){
        $id=$request->param("id");
        $controllers=$this->getc();
        $models=$this->getm();
        $models::update(["is_delete"=>1],["id"=>$id]);
        $models::destroy($id);

    }
    //回复删除功能

    public function unDelete(){
        $member_id=Session::get("member_id");
        $models=$this->getm();
        $models::update(["delete_time"=>null,"is_delete"=>0],["is_delete"=>1,"member_id"=>$member_id]);
    }

    //  编辑模板渲染
    public function edit(Request $request){
        $id=$request->param("id");
        $controllers=$this->getc();
        $models=$this->getm();
        $result=$models::get($id);
        $data=$result->getData();
        $this->view->assign("data",$data);
        return $this->view->fetch($controllers."_edit");
    }
    //设置状态
    public function setStatus(Request $request){
        $user_id=$request->param("id");
        $models=$this->getm();
        $result=$models::get($user_id);
        if($result->getData("status")==1){
            $models::update(["status"=>0],["id"=>$user_id]);
        }else{
            $models::update(["status"=>1],["id"=>$user_id]);
        }
    }

    //添加模板渲染
    public function add(){
        $controllers=$this->getc();
        return $this->view->fetch($controllers."_add");
    }
    public function delDirAndFile($path, $delDir = FALSE) {
        if (is_array($path)) {
            foreach ($path as $subPath)
                delDirAndFile($subPath, $delDir);
        }
        if (is_dir($path)) {
            $handle = opendir($path);
            if ($handle) {
                while (false !== ( $item = readdir($handle) )) {
                    if ($item != "." && $item != "..")
                        is_dir("$path/$item") ? delDirAndFile("$path/$item", $delDir) : unlink("$path/$item");
                }
                closedir($handle);
                if ($delDir)
                    return rmdir($path);
            }
        } else {
            if (file_exists($path)) {
                return unlink($path);
            } else {
                return FALSE;
            }
        }
        clearstatcache();
    }

    public function alldelete(){
        $models=$this->getm();
        $ids=input("post.delete_id/a");
        foreach ($ids as $id){
            $models::update(["is_delete"=>1],["id"=>$id]);
            $models::destroy($id);
        }
        return ['status'=>1,'message'=>"删除成功"];
    }
}
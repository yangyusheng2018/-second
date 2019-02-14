<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/19
 * Time: 10:12
 */

namespace app\index\controller;

use app\index\controller\Base;
use app\index\model\Cate as CateModel;
use think\Model;
use think\Request;
use think\Validate;
class Cate extends Base
{


    public function cate_list(){
        $catemodel=new CateModel();
        $data=$catemodel->getAllData();
        $this->view->assign("data",$data);
     return $this->view->fetch();
    }
    public function cate_edit(Request $request){
        $catemodel=new CateModel();
        $data1=$catemodel->getAllData();
        $this->view->assign("data1",$data1);

        $id=$request->param("id");
        $controllers=$this->getc();
        $models=$this->getm();
        $result=$models::get($id);
        $data=$result->getData();
        $this->view->assign("data",$data);
        return $this->view->fetch($controllers."_edit");
    }
public function add_cate(Request $request){
    $status = 0;
    $messages = '添加失败';
    $data=$this->request->param();

if($data["pid"]!=0){
    $pdata=CateModel::get($data["pid"]);
    $pdatalevle=$pdata->getData("level");
    $data["level"]=$pdatalevle+1;
}else{
    $data["level"]=1;
}

    if($data["name"]!=""){
        $insterTrue=CateModel::create($data);
        if ($insterTrue!=null){
            $status=1;
            $messages="添加成功";
        }else{
            $status=0;
            $messages="添加不成功";
        }
    }else{
        $status=0;
        $messages="名称不能为空";
    }
    return ['status'=>$status,'message'=>$messages];

}

    public function edit_cate(Request $request){
        $status = 0;
        $messages = '修改失败';
        $data=$this->request->param();

        $pdata=CateModel::get($data["pid"]);
        $pdatalevle=$pdata->getData("level");
        $data["level"]=$pdatalevle+1;

        if($data["name"]!=""){
            $insterTrue=CateModel::update($data,["id"=>$data["id"]]);
            if ($insterTrue!=null){
                $status=1;
                $messages="修改成功";
            }else{
                $status=0;
                $messages="修改不成功";
            }
        }else{
            $status=0;
            $messages="名称不能为空";
        }
        return ['status'=>$status,'message'=>$messages];

    }

    public function delete_cate(Request $request){
        $id=$request->param("id");
        CateModel::update(["is_delete"=>1],["id"=>$id]);
        CateModel::destroy($id);
        $data=CateModel::all();
        $newcate=new CateModel();
        $newcate->redelete($data,$id);

    }



}
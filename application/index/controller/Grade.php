<?php
/**
 * Created by PhpStorm.
 * User: yang
 * Date: 2018/8/30
 * Time: 22:05
 */

namespace app\index\controller;

use app\index\model\Grade as GradeModel;
use think\Request;
use app\index\model\Teacher;
use app\index\controller\Base;
use think\Model;
use think\Db;
use think\Session;
use think\Validate;
class Grade extends Base
{
    public function grade_list(){
        $this->view->count=GradeModel::count();
        $this->view->assign("title","班级列表");
        $this->view->assign("keywords","学生管理系统");
        $this->view->assign("description","thinkphp5实例开发");
            $users=GradeModel::all();

        foreach ($users as $value){
            $data=[
                "name"=>$value->name,
                "id"=>$value->id,
                'length' => $value->length,
                'price' => $value->price,
                'status' => $value->status,
                'create_time' => $value->create_time,
                "teacher"=>isset($value->teacher->name)? $value->teacher->name:"未分配",
            ];
            $gradeList[] = $data;
        }
        $this->view->assign("users",$gradeList);

        return $this->view->fetch();

    }
    public function validata_grade($data){
        $rule = [
            "name" => "require",
            "length" => "require",
            "price" => "require",
            "status" => "require",
        ];
        $mes=[
            "name" => "名称不能为空",
            "length" => "年制不能为空",
            "price" => "学费不能为空",
            "status" => "状态设置不能为空",
        ];
        $validata=new Validate($rule,$mes);
       return ["result"=>$validata->check($data),"message"=>$validata->getError()];
    }


    public function setStatus(Request $request){
        $id=$this->request->param("id");
        $status=GradeModel::get($id)->getData("status");
        if($status==1){
            GradeModel::update(["status"=>0],["id"=>$id]);
        }else{
            GradeModel::update(["status"=>1],["id"=>$id]);
        }

    }
    public function grade_add(){
        return $this->view->fetch();
    }
    public function add_grade(Request $request)
    {
        $message="添加失败";
        $status=0;
        $data = $request->param();
        $vali_result=$this->validata_grade($data);

        $name=$this->request->param("name");
        $grades=GradeModel::get(['name'=>$name]);
        $is_grade=0;
        if($grades!=null){
            $status=0;
            $message="班级名已存在";
            $is_grade=1;
        }


    if($vali_result["result"]===true&$is_grade!=1){
        $inster_status = GradeModel::create($data);
        if($inster_status!=null){
            $status=1;
            $message="添加成功";
        }
    }else{
        $message=$vali_result["message"];
    }
        if($grades!=null){
            $message="班级名已存在";
        }
        return ["status"=>$status,"message"=>$message];
    }
    public function checkUserName(Request $request){
        $name=$this->request->param("name");
        $grades=GradeModel::get(['name'=>$name]);
        $status=1;
        $message="";
        if($grades!=null){
            $status=0;
            $message="班级名已存在";
        }
        if($name==""){
            $status=0;
            $message="班级名不能为空";
        }
        return["status"=>$status,"message"=>$message];

    }
    public function grade_edit(Request $request){
        $data_id=$this->request->param("id");
        $grades=GradeModel::get($data_id);
        $data=$grades->getData();
        $this->view->assign("pp",$data);
       return $this->view->fetch();
    }

    public function edit_grade(){
        $data_id=$this->request->param("id");
        $data=$this->request->param();

        $updata_data=[
            "name"=>$data["name"],
            "length"=>$data["length"],
            "price"=>$data["price"],
            "status"=>$data["status"],
        ];
        $grade_result=$this->validata_grade($data);

        if($grade_result["result"]==1){
            $updata_status=GradeModel::update($updata_data,["id"=>$data_id]);
        }
        if($updata_status!=null){
            $status=1;
            $message="修改成功";
        }else{
            $status=0;
            $message=$grade_result["message"];
        }
        return ["status"=>$status,"message"=>$message];
    }




}
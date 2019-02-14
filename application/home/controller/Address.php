<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/23
 * Time: 13:29
 */

namespace app\home\controller;
use app\index\model\Address as AddressModel;
use app\home\controller\Base;
use think\Request;
use think\Session;
use think\Validate;
class Address extends Base
{
    public function address_add(){
       return $this->view->fetch();
    }

    public function add_address(Request $request){
        $data=$request->param();

        $data["member_id"]=Session::get("member_id");

        $is_update=AddressModel::create($data);
        if($is_update){
            $status=1;
            $message="添加成功";
        }else{
            $status=0;
            $message="添加失败";
        }
        return ['status'=>$status,'message'=>$message];
    }

    public function address_list(){
        $this->islogin();
        $member_id=Session::get("member_id");
        $address=new AddressModel();
        $data=$address->member_address($member_id);
        if($data){
            $count=count($data);
        }else{
            $count=0;
        }


        $this->assign([
            "data"=>$data,
            "count"=>$count,
            ]);
        return $this->view->fetch();
    }



}
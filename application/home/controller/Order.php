<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/23
 * Time: 18:16
 */

namespace app\home\controller;
use app\home\controller\Base;
use app\index\model\Order as OrderModel;
use app\home\model\Car;
use think\Request;
use think\Session;

class Order extends Base
{
    public function _initialize()
    {
        if(!session('member_id')){
            $this->error("用户未登录",url("/home/member/login"));
        }
    }

    public function add_order(Request $request){
        $data=$this->request->param();
        $data["member_id"]=Session::get("member_id");

        $ordermodel=new OrderModel();
        $id=$ordermodel->insertGetId($data);
        if($id){
            $carmodel=new Car();
            $carmodel->where(["member_id"=>$data["member_id"]])->delete();
            $status=1;
            $message="订单生成成功";
        }else{
            $status=0;
            $message="订单生成失败";
        }
        return ["status"=>$status,"message"=>$message,"id"=>$id];
    }
    public function orderbyid(Request $request){
        $ordermodel=new OrderModel();
        $id=$request->param("id");
        $data=OrderModel::get($id);
        $goods_list=$ordermodel->order_detail($data);
        $this->assign([
            "goods_list"=>$goods_list,
            "data"=>$data,
        ]);
        return $this->fetch("orderbyid");
    }

    public function order_list(){
        if(!session('member_id')){
            $this->error("用户未登录",url("/home/login/login"));
        }
        $this->islogin();
        $ordermodel=new OrderModel();
        $member_id=Session::get("member_id");
        $data=$ordermodel->where(["member_id"=>$member_id])->select();
        $count=count($data);
        $data=$ordermodel->foreachedata($data);

        $this->view->assign("count",$count);
        $this->view->assign("data",$data);
        return $this->view->fetch();
    }


}
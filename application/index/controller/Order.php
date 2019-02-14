<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/27
 * Time: 16:27
 */

namespace app\index\controller;

use app\index\controller\Base;
use app\index\model\Order as OrderModel;
use app\index\model\Address;
use think\Model;
use think\Request;
use think\Session;
class Order extends Base
{


    public function order_list(){
        $data=OrderModel::all();
        $count=count($data);
        $this->view->assign("title","订单列表");
        $this->view->assign("count",$count);
        $ordermodel=new OrderModel();
        $goodsList=$ordermodel->foreachedata($data);
        $this->view->assign("data",$goodsList);
        return $this->view->fetch();
    }
    public function order_edit(){
        $id=$this->request->param("id");
        $data=OrderModel::get($id)->getData();
        $address_id=$data["address_id"];
        $address_data=Address::get($address_id)->getData();
        $this->view->assign("data",$data);
        $this->view->assign("address_data",$address_data);
        return $this->view->fetch();
    }
    public function edit_order(Request $request){
            $data=$request->param();
            $order_data=[
                "payment"=>$data["payment"],
                "delivery"=>$data["delivery"],
                "total"=>$data["total"],
            ];
            $address_data=[
                "name"=>$data["name"],
                "privince"=>$data["privince"],
                "district"=>$data["district"],
                "address"=>$data["address"],
                "code"=>$data["code"],
                "phone"=>$data["phone"],
            ];
            $is_add=Address::update($address_data,["id"=>$data["address_id"]]);
            $is_order=OrderModel::update($order_data,["id"=>$data["id"]]);
            if($is_add!=null&$is_order!=null) {
                $status = 1;
                $messages = "修改成功";
            }else{
                $status = 0;
                $messages = "修改失败";
            }
        return ['status'=>$status,'message'=>$messages];

    }

    public function selects(Request $request){
        $member_id=Session::get("member_id");

        $inputs=$request->param("inputs");
        $firstdate=$request->param("firstdate");
        $lastdate=$request->param("lastdate");
        $firstdate=strtotime($firstdate);
        $lastdate=strtotime($lastdate);
        $orders=new OrderModel();
        $where=[];$where1=[];

        if($firstdate!=""){
            $where["create_time"]=[">=",$firstdate];
        }
        if($lastdate!=""){
            $where2["create_time"]=["<=",$lastdate];
        }
        if($inputs!=""){
            $where1["id"]=$inputs;
            $where1["member_id"]=$inputs;

        }
        if(!empty($member_id)){
            $where1["member_id"]=$member_id;
        }

        $res=$orders-> where(function ($query) use ($where1){
            $query->whereOr($where1);
        })->
        where(function ($query) use ($where){
            $query->where($where);
        })->
        where(function ($query) use ($where2){
            $query->where($where2);
        })
            ->select();

        $counts=count($res);
        $goodsList=[];

        $ordermodel=new OrderModel();
        $goodsList=$ordermodel->foreachedata($res);

        $this->view->assign("count",$counts);

        if($goodsList){
            $this->view->assign("data",$goodsList);
            return $this->view->fetch("order_list");
        }else{
            return $this->view->fetch("/index/nores");
        }


    }
















}
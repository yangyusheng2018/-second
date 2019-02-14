<?php
/**
 * Created by PhpStorm.
 * User: yang
 * Date: 2018/10/16
 * Time: 0:26
 */

namespace app\home\controller;

use app\home\controller\Base;
use app\home\model\Car as CarModel;
use app\index\model\Brand;
use app\index\model\Cate;
use think\Session;
use think\Request;
use app\index\model\Address;
class Car extends Base
{
    public function add_car(Request $request){
        $goods_id=$this->request->param("id");
        $member_id=Session::get('member_id');
        $goods=\app\index\model\Goods::get($goods_id);
        $price=$goods->saleprice*$goods->discount*0.1;
        $car=new CarModel();
        if($goods["stock"]==0){
            $message="库存不足";
        }else{
            if(isset($member_id)){

                $isset_goods=CarModel::get(["member_id"=>$member_id,"goods_id"=>$goods_id]);
                if(!empty($isset_goods)){
                    $number=1+$isset_goods->number;

                    $up=CarModel::update(["number"=>$number],["member_id"=>$member_id,"goods_id"=>$goods_id]);
                    if($up){
                        $message="添加成功";
                    }else{
                        $message="添加失败";
                    }
                }else{
                    $add=CarModel::create(["member_id"=>$member_id,"goods_id"=>$goods_id,"number"=>1,"price"=>$price]);
                    if($add){
                        $message="添加成功";
                    }else{
                        $message="添加失败";
                    }
                }
            }else{

                $car_goods=Session::get("car.$goods_id");
               if(!empty($car_goods)){
                   $number=$car_goods["number"]+1;
                   $data=["number"=>$number,"price"=>$price,"goods_name"=>$goods->goods_name,"imageurl"=>$goods->imageurl,"goods_id"=>$goods->id];
//                   Session::set("car.$goods_id",$data);
                   session("car.$goods_id",$data);
                   $message="添加成功";
               }else{
                    $data=["number"=>1,"price"=>$price,"goods_name"=>$goods->goods_name,"imageurl"=>$goods->imageurl,"goods_id"=>$goods->id];
                   Session::set("car.$goods_id",$data);
                   $message="添加成功";



               }
            }
        }

    }
    public function getcar(){
        $member_id=Session::get('member_id');
        if(isset($member_id)){
           $carmodel=new CarModel();
           $cars=$carmodel->where(["member_id"=>$member_id])->select();

            $carList=[];
            foreach ($cars as $value){
                $v=[
                    "member_id"=>$value->member_id,
                    "id"=>$value->id,
                    'goods_id'=>$value->goods_id,
                    'number'=>$value->number,
                    'create_time' => $value->create_time,
                    'price' => $value->price,
                    'goods_name' => $value->goods->goods_name,
                    'imageurl'=>$value->goods->imageurl,

                ];
                $carList[] = $v;
            }
            $cars=$carList;

        }else{
            $cars=Session::get("car");
        }
        return $cars;
    }
    public function car_list(){
        $cars=new Car();

        $member_id=Session::get("member_id");
        $cars=$cars->getcar();
        $branddata=Brand::all();
        $catedata=Cate::all();

        if(!empty($member_id)){
            $address=new Address();
            $address=$address->order_address($member_id);
        }else{
            $address=[];
        }

        $this->view->assign([
            "catedata"=>$catedata,
            "branddata"=>$branddata,
            "address"=>$address,
            "car"=>$cars,
        ]);

        return $this->view->fetch("member/car_list");
    }

    public function del_car(Request $request){

        $member_id=Session::get('member_id');
        $id=$this->request->param("id");
        if(isset($member_id)){
            $carmodel=new CarModel();
            $carmodel->where(["goods_id"=>$id])->delete();
        }else{
            session("car.$id",null);
        }
    }
}
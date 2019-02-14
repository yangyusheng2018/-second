<?php
/**
 * Created by PhpStorm.
 * User: yang
 * Date: 2018/10/6
 * Time: 20:56
 */

namespace app\home\controller;

use app\index\model\Cate;
use app\index\model\Comment;
use app\index\model\Member;
use think\Session;

class Index extends Base
{


    public function index(){
        $good=new \app\home\controller\Goods();

        $discount=$good->order_by("discount");
        $start=$good->order_by("salednum","desc");
        $goodsList=$good->order_by("create_time","desc");
        $prices=$good->order_by("saleprice");
        $comdata=$this->comdata();
        $this->view->assign($comdata);
        $this->view->assign([
            "start"=>$start,
            "prices"=>$prices,
            "discount"=>$discount,
            "good"=>$goodsList,
        ]);

        return $this->fetch();


    }
    public function getlist($data){
        $goodsList=[];
        foreach ($data as $value){

            $comment=new Comment();
            $c_count=$comment->where(['goods_id'=>$value["id"]])->select();
            $comment1=Comment::get(["goods_id"=>$value["id"]]);

             $content=$comment1["content"];
             $member_id=$comment1["member_id"];

            $member=Member::get($member_id);

            $data=[
                "goods_name"=>$value->goods_name,
                "id"=>$value->id,
                'description' => $value->description,
                'imageurl' => $value->imageurl,
                'saleprice' => $value->saleprice,
                'discount' => $value->discount,
                "c_count"=>count($c_count),
                "content"=>$content,
                "member"=>$member["name"],
            ];
                $goodsList[] = $data;


        }
        return $goodsList;
    }
    public function about(){
        $catedata=Cate::all();
        $carmodel=new Car();
        $car=$carmodel->getcar();
        $this->assign("catedata",$catedata);
        $this->assign("car",$car);
        return $this->fetch();
    }



}
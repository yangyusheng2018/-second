<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/9
 * Time: 19:55
 */

namespace app\home\controller;

use app\home\controller\Base;
use app\index\model\Goods as GoodsModel;
use think\Request;
use app\index\model\Cate;

use app\index\model\Brand;
use app\index\model\Comment;
class Goods extends Base
{
    public function getscore($id){
        $comment=new Comment();
        $scores=$comment->where(["goods_id"=>$id])->column('score');
        if(count($scores)==0){
            return 0;
        }else{
            return array_sum($scores)/count($scores);
        }


    }
    public function order_by($orders,$turn="asc"){
        $goods=new \app\home\model\Goods();
        $sql=$orders." ".$turn;
        $data=$goods->order($sql)->select();
        $discount=$this->getlist($data);
        return $discount;
    }


    public function getcomment($id){
        $comment=new Comment();
        $comment=$comment->where(["goods_id"=>$id])->select();
        $commentList=[];
        foreach ($comment as $value){
            $v=[
                "content"=>$value->content,
                "id"=>$value->id,
                'score'=>$value->score,
                'create_time' => $value->create_time,
                'member' => $value->member->name,
            ];
            $commentList[] = $v;
        }

        return $commentList;

    }
    public function getcommentc($id){
        $comment=new Comment();
        $scores=$comment->where(["goods_id"=>$id])->column('score');
        return count($scores);
    }
    public function getlist($data){
        $goodsList=[];
        foreach ($data as $value){
           $score=$this->getscore($value["id"]);
            $c_count=$this->getcommentc($value["id"]);
            $value=[
                "goods_name"=>$value->goods_name,
                "id"=>$value->id,
                'description' => $value->description,
                'imageurl' => $value->imageurl,
                'saleprice' => $value->saleprice,
                'marketprice' => $value->marketprice,
                'discount' => $value->discount,
                "c_count"=>$c_count,
                "score"=>$score,
            ];
            $goodsList[] = $value;


        }
        return $goodsList;


    }
    public function detail(Request $request){
        $id=$this->request->param("id");

        $goodmodel=new GoodsModel();
        $data=$goodmodel->where(["id"=>$id])->find();
        $data["score"]=$this->getscore($id);
        $data["c_count"]=$this->getcommentc($id);
        $comments=$this->getcomment($id);

        $comdata=$this->comdata();
        $this->view->assign($comdata);
        $this->view->assign([
            "data"=>$data,
            "comments"=>$comments,
            ]);
        return $this->fetch();
    }

    public function bybrand(Request $request){


        $id=$request->param("id");
        $brand=Brand::get($id);
        $list_name=$brand->name;
        $goodsmodel=new GoodsModel();
        $data=$goodsmodel->where(["brand_id"=>$id])->paginate(5);
        $page = $data->render();
        $this->assign('page', $page);

        $count=count($data);
        $data=$this->getlist($data);
        $discount=$this->order_by("discount");

        $comdata=$this->comdata();
        $this->view->assign($comdata);
        $this->view->assign([
            "count"=>$count,
            "data"=>$data,
            "list_name"=>$list_name,
            "discount"=>$discount,
            ]);
        return $this->fetch("goods_list");

    }

    public function bycate(Request $request){
        $id=$request->param("id");
        $brand=Cate::get($id);
        $list_name=$brand->name;
        $catemodel=new Cate();
        $data=$catemodel->getcatedatas($id);
        $page = $data->render();
        $this->assign('page', $page);
        $count=count($data);
        $data=$this->getlist($data);
        $discount=$this->order_by("discount");
        $comdata=$this->comdata();
        $this->view->assign($comdata);
        $this->view->assign([
            "count"=>$count,
            "data"=>$data,
            "list_name"=>$list_name,
            "discount"=>$discount,
        ]);


        return $this->fetch("goods_list");

    }
}
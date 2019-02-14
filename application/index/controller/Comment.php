<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/28
 * Time: 16:56
 */

namespace app\index\controller;

use app\index\controller\Base;
use app\index\model\Comment as CommentModel;
use think\Model;
use think\Request;
class Comment extends Base
{
    public function foreachedata($data){
        foreach ($data as $value){
            $data=[
                "id"=>$value->id,
                "member_id"=>$value->member_id,
                "goods_id"=>$value->goods_id,
                'status' => $value->status,
                'content' => $value->content,
                'score' => $value->score,
                'create_time' => $value->create_time,
                "username"=>isset($value->member->username)? $value->member->username:"未分类",
                "goodsname"=>isset($value->goods->goods_name)? $value->goods->goods_name:"未分类",
            ];
            $goodsList[] = $data;
        }
        return $goodsList;
    }
    public function comment_list(){
        $data=CommentModel::all();
        $count=count($data);
        $this->view->assign("title","评论列表");
        $this->view->assign("count",$count);

        $goodsList=$this->foreachedata($data);
        $this->view->assign("data",$goodsList);
        return $this->view->fetch();
    }
    public function selects(Request $request){
        $inputs=$request->param("inputs");
        $firstdate=$request->param("firstdate");
        $lastdate=$request->param("lastdate");
        $firstdate=strtotime($firstdate);
        $lastdate=strtotime($lastdate);
        $orders=new CommentModel();
        $where=[];$where1=[];

        if($firstdate!=""){
            $where["create_time"]=[">=",$firstdate];
        }
        if($lastdate!=""){
            $where["create_time"]=["<=",$lastdate];
        }
        if($inputs!=""){
            $where1["id"]=$inputs;
            $where1["member_id"]=$inputs;
            $where1["goods_id"]=$inputs;
            $where1["content"]=["like",'%'.$inputs.'%'];
            $where1["score"]=$inputs;

        }
        $res=$orders-> where(function ($query) use ($where1){
            $query->whereOr($where1);
        })->
        where(function ($query) use ($where){
            $query->where($where);
        })
            ->select();
        $counts=count($res);
        $goodsList=[];

        $goodsList=$this->foreachedata($res);

        $this->view->assign("count",$counts);

        if($goodsList){
            $this->view->assign("data",$goodsList);
            return $this->view->fetch("comment_list");
        }else{
            return $this->view->fetch("/index/nores");
        }


    }



    }
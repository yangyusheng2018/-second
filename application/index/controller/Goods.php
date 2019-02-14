<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/13
 * Time: 14:34
 */

namespace app\index\controller;

use app\index\controller\Base;
use app\index\model\Goods as GoodsModel;
use think\Model;
use think\Request;
use think\Db;
use think\Session;
use think\Validate;
use app\index\model\Cate;
use app\index\model\Brand;
use think\File;
use think\Image;
class Goods extends Base
{
    public function foreachedata($data){
        $goodsList=[];
        foreach ($data as $value){


            $data=[
                "goods_name"=>$value->goods_name,
                "id"=>$value->id,
                'description' => $value->description,
                'marketprice' => $value->marketprice,
                'discount' => $value->discount,
                'saleprice' => $value->saleprice,
                'addtime' => $value->create_time,
                'status' => $value->status,
                "cate"=>isset($value->cate->name)? $value->cate->name:"未分类",
                "brand"=>isset($value->brand->name)? $value->brand->name:"未分类",
            ];
            $goodsList[] = $data;
        }
        return $goodsList;
    }
    public function goods_list(){
        $data=GoodsModel::all();
        $count=count($data);
        $this->view->assign("title","产品列表");

        $this->view->assign("count",$count);

        $goodsList=$this->foreachedata($data);
        $this->view->assign("data",$goodsList);
        return $this->view->fetch();
    }

    public function goods_add(){
        $catemodel=new Cate();
        $data=$catemodel->getAllData();
        $data1=Brand::all();
        $this->view->assign("data1",$data1);
        $this->view->assign("data",$data);
        return $this->view->fetch();
    }
    public function add_goods(Request $request){
        $data=$this->request->param();
        $data["start_time"] = strtotime($data["start_time"]);
        $data["end_time"] = strtotime($data["end_time"]);
        $status = 0;
        $messages = '添加失败';
            if($data["goods_name"]!=""){
                $insterTrue=GoodsModel::create($data);
                $lastid=Db::name('goods')->getLastInsID();
            }else{
                $messages="名称不能为空";
                $insterTrue=null;
            }

            if($insterTrue!=null){
                $status=1;
                $messages="添加成功";
                $files=$request->file("file-Portrait1");
                $dir="upload/goods/".$lastid;// 自定义文件上传路径
                if(!is_dir($dir)){
                    mkdir($dir,0777,true);
                }

                $i=1;
                $imageurl="";
                foreach($files as $picFile){
                    $imgnames=time()+$i;
                    $info = $picFile->move($dir,$imgnames);
                $imageurl.="/".str_replace("\\","/",$info->getPathname()).",";
                $i++;
            }
                GoodsModel::update(["imageurl"=>$imageurl],["id"=>$lastid]);
            }

        return ['status'=>$status,'message'=>$messages];
    }

    public function goods_edit(Request $request){
        $id=$this->request->param("id");
        $catemodel=new Cate();
        $data=$catemodel->getAllData();
        $data1=Brand::all();
        $this->view->assign("data1",$data1);
        $this->view->assign("data",$data);
        $data3=GoodsModel::get("$id")->getData();
        $this->view->assign("data3",$data3);
        return $this->view->fetch();
    }
    public function pic_edit(Request $request){
        $id=$this->request->param("id");
        $data3=GoodsModel::get("$id")->getData();
        $counts=substr_count( $data3["imageurl"],",");
        $data3["imageurl"] = substr($data3["imageurl"],0,strlen($data3["imageurl"])-1);
        $imgs=explode(",",$data3["imageurl"]);
        $this->view->assign("counts",$counts);
        $this->view->assign("imgs",$imgs);
        $this->view->assign("data3",$data3);
        return $this->view->fetch();
    }
    public function edit_goods(Request $request){
        $data=$this->request->param();
        $id=$this->request->param("id");
        $data["start_time"] = strtotime($data["start_time"]);
        $data["end_time"] = strtotime($data["end_time"]);
        $data["content"]=$data["editorValue"];
        unset($data["editorValue"]);
        unset($data["id"]);
        $status = 0;
        $messages = '修改失败';
        if($data["goods_name"]!=""){
            $insterTrue=GoodsModel::update($data,["id"=>$id]);
        }else{
            $messages="名称不能为空";
            $insterTrue=null;
        }

        if($insterTrue!=null){
            $status=1;
            $messages="修改成功";
        }

        return ['status'=>$status,'message'=>$messages];
    }
    public function delete_goods(Request $request)
    {
       $id=$this->request->param("id");
        GoodsModel::update(["is_delete"=>1],["id"=>$id]);
        GoodsModel::destroy($id);
      $this->delDirAndFile("upload/goods/".$id,true);
    }
public function delete_pic(Request $request){
    $imgurl=$this->request->param("imgurl");
    $id=$this->request->param("id");
    $counts=$this->request->param("counts");
    $imgurl = substr($imgurl,1);
    if(file_exists($imgurl)){
        unlink($imgurl);
        $counts=$counts-1;
    }
    $goods=GoodsModel::get($id);
    $imgurl1=$goods->getData("imageurl");
    $imgurl1=str_replace("/".$imgurl.",","",$imgurl1);
    GoodsModel::update(["imageurl"=>$imgurl1],["id"=>$id]);
}
    public function edit_pic(Request $request){
        $redata=$this->request->param();
        $status = 0;
        $messages = '修改失败';
            $files=$request->file("file-Portrait1");

        $id=$this->request->param("id");
        $data=GoodsModel::get("$id")->getData();
        $counts=substr_count( $data["imageurl"],",");
        $imageurl=$data["imageurl"];
        $data["imageurl"] = substr($data["imageurl"],0,strlen($data["imageurl"])-1);
        $imgs=explode(",",$data["imageurl"]);

        $i=0;
        foreach($files as $picFiles){
            $i++;
        }
        if(($i+$counts)>4){
            $status = 0;
            $messages = '图片不能多于四个';
        }else{
            $dir="upload/goods/".$id;// 自定义文件上传路径
            if(!is_dir($dir)){
                mkdir($dir,0777,true);}
                    $j=0;
            foreach($files as $picFile){
                $imgnames=time()+$j;
                $info = $picFile->move($dir,$imgnames);
                $j++;
                $imageurl.="/".str_replace("\\","/",$info->getPathname()).",";
            }

            GoodsModel::update(["imageurl"=>$imageurl],["id"=>$id]);
            $status = 1;
            $messages = '修改完成';
        }

        return ['status'=>$status,'message'=>$messages];
    }
    public function selects(Request $request){
        $inputs=$request->param("inputs");
        $firstdate=$request->param("firstdate");
        $lastdate=$request->param("lastdate");
        $firstdate=strtotime($firstdate);
        $lastdate=strtotime($lastdate);
        $orders=new GoodsModel();
        $where=[];
        $where2=[];
        if($firstdate!=""){
            $where["create_time"]=[">=",$firstdate];
        }
        if($lastdate!=""){
            $where["create_time"]=["<=",$lastdate];
        }
        if($inputs!=""){
            $where["id"]=$inputs;
            $where2["goods_name"]=["like",'%'.$inputs.'%'];
        }
        $res=$orders->where($where)->whereOr($where2)->select();
        $counts=count($res);
        $goodsList=[];
        $goodsList=$this->foreachedata($res);
        $this->view->assign("count",$counts);
        if($goodsList){
            $this->view->assign("data",$goodsList);
            return $this->view->fetch("goods_list");
        }else{
            return $this->view->fetch("/index/nores");
        }



    }

}
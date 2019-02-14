<?php
/**
 * Created by PhpStorm.
 * User: yang
 * Date: 2018/9/16
 * Time: 19:33
 */

namespace app\index\controller;

use app\index\controller\Base;
use app\index\model\Brand as BrandModel;
use think\Model;
use think\Request;
use think\Session;
use think\Validate;
use think\File;
use think\Image;
class Brand extends Base
{


    public function add_brand(Request $request){
        $data=$this->request->param();

        $status = 0;
        $messages = '添加失败';
        $rule=[
            "name"=>"require" ,
            "file"=>"file|image",
            "description"=>"require",
        ];
        $msg = [
            'name'=>'名称格式错误',
            "file"=>"文件不合格",
            'description'=>'描述格式错误',
        ];
        $validate = new Validate($rule,$msg);
        $result=$validate->check($data);

        $messages=$validate->getError();
        $name=$this->request->param("name");
        $description=$this->request->param("description");
        $is_user=BrandModel::get(["name"=>$name]);
        if($is_user!=null){
            $status=0;
            $messages="品牌已存在";
        }
        if($result==true&$is_user==null){
            $indata=["name"=>$name,"description"=>$description];
            $insterTrue=BrandModel::create($indata);
            if($insterTrue!=null){
                $status=1;
                $messages="添加成功";
                $file =$request->file("file");
                $filename=$file->getInfo('name');
                $brands=BrandModel::get(["name"=>$data["name"]]);
                $id=$brands->getData("id");
                $dir="upload/brand/".$id;// 自定义文件上传路径
                if(!is_dir($dir)){
                    mkdir($dir,0777,true);
                }
                $info=$file->move($dir,$filename);// 将文件上传指定目录
                //获取文件的全路径
                $imgurl=str_replace("\\","/",$info->getPathname());
                BrandModel::update(["logo"=>"/".$imgurl],["name"=>$data["name"]]);
            }
        }
        return ['status'=>$status,'message'=>$messages];
    }

    public function edit_brand(){
        $data=$this->request->param();
        $id=$data["id"];
        $status = 0;
        $messages = '修改失败';
        $rule=[
            "name"=>"require" ,
            "file"=>"file|image",
            "description"=>"require",
        ];
        $msg = [
            'name'=>'名称格式错误',
            "file"=>"文件不合格",
            'description'=>'描述格式错误',
        ];
        $validate = new Validate($rule,$msg);
        $result=$validate->check($data);

        $messages=$validate->getError();
        $name=$this->request->param("name");
        $description=$this->request->param("description");
        $is_user=BrandModel::get(["name"=>$name]);
        $is_user1=BrandModel::get(["name"=>$name,"id"=>$id]);
        if($is_user!=null&$is_user1==null){
            $status=0;
            $messages="品牌已存在";

        }
        if($result==true&($is_user==null|$is_user1!=null)){
            $indata=["name"=>$name,"description"=>$description];
            $insterTrue=BrandModel::update($indata,["id"=>$id]);
            if($insterTrue!=null){
                $status=1;
                $messages="修改成功";
                $file=$this->request->file("file");
                if($file!=null){
                    $filename=$file->getInfo('name');
                    $dir="upload/brand/".$id;// 自定义文件上传路径
                    if(!is_dir($dir)){
                        mkdir($dir,0777,true);
                    }
                    $info=$file->move($dir,$filename);// 将文件上传指定目录
                    //获取文件的全路径
                    $imgurl=str_replace("\\","/",$info->getPathname());
                    BrandModel::update(["logo"=>"/".$imgurl],["id"=>$id]);
                }

            }
        }
        return ['status'=>$status,'message'=>$messages];
    }

    public function datadel(Request $request){
        $id=$this->request->param("delete_id");
        BrandModel::update(["is_delete"=>1],["id"=>$id[0]]);
        BrandModel::destroy($id[0]);
    }

    public function selects(Request $request){
        $inputs=$request->param("inputs");
        $orders=new BrandModel();
        $where["id"]=$inputs;
        $where2["name"]=["like",'%'.$inputs.'%'];
        $where3["description"]=["like",'%'.$inputs.'%'];
        $res=[];
        $res=$orders->where($where)->whereOr($where2)->whereOr($where3)->select();
        $counts=count($res);
        $this->view->assign("count",$counts);

        if($res){
            $this->view->assign("data",$res);
            return $this->view->fetch("brand_list");
        }else{
            return $this->view->fetch("/index/nores");
        }


    }

}
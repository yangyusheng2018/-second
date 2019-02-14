<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/11
 * Time: 17:21
 */

namespace app\home\controller;
use app\home\model\Car;
use app\index\model\Member as MemberModel;
use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Session;
use think\Validate;
use app\index\controller\Common;
use app\home\model\Collections;
class Member extends Controller
{


    public function login(){
        $id=Session::get("member_id");
        if(!empty($id)){
            $this->error("用户已登录",url("/"));
        }
        return $this->fetch();
    }
    public function logout(Request $request){

        Session::delete("member_id");
        Session::delete("member");

    }
    public function checkLogin(Request $request){
        $status=0;
        $result="";
        $data=$request->param();
        $rule=[
            'username'=>"require",
            'password'=>"require",
            'verify'=>"require|captcha",
        ];

        $result=$this->validate($data,$rule);
        $username=$data['username'];
        $password=md5($data['password']);
        if($result==1){



            $map=['username'=>$username,
                'password'=>$password,
            ];
            $map1=['username'=>$username,
                'password'=>$password,
                "status"=>1,
            ];
            $user=MemberModel::get($map);
            $user1=MemberModel::get($map1);
            if($user==null){
                $result="密码和账号不匹配或者用户不存在";

            }elseif($user1==null){


                $result="此用户已被禁用";
            }else {
                $status = 1;
                $result = "登陆成功点击确定继续";

                $cars=Session::get("car");
                $collections=Session::get("collections");
                if(!empty($cars)){
                    foreach ($cars as $key=>$valus){

                        $data=[
                            "member_id"=>$user->id,
                            "price"=>$valus["price"],
                            "goods_id"=>$key,
                            "number"=>$valus["number"],
                        ];
                        $isset=Car::get(["goods_id"=>$key,]);

                        if(empty($isset)){
                            Car::create($data);
                        }else{
                            $number=$valus["number"]+$isset->number;
                            Car::update(["number"=>$number],["goods_id"=>$key,]);
                        }
                    }
                }
                if(!empty($collections)){
                    foreach ($collections as $valus){

                        $data=[
                            "member_id"=>$user->id,
                            "goods_id"=>$valus,
                        ];
                        $isset=Collections::get($data);

                        if(empty($isset)){
                            Collections::create($data);
                        }
                    }
                }

                Session::set("member_id", $user->id);
                session("car",null);
                Session::set("member", $user->getData());

            }
        }
        return ['status'=>$status,'message'=>$result,'data'=>$data,];
    }

    public function member_detail(){
        $id=Session::get("member_id");
        if(empty($id)){
            $this->error("用户未登录",url("/home/member/login"));
        }
        $member_id=Session::get("member_id");
        $data=MemberModel::get("$member_id");
        $this->assign("data",$data);
        return $this->view->fetch("personal/detail");
    }

    public function add(){
        return $this->view->fetch("member_add");
    }

    public function add_member(){
        $data=$this->request->param();

        $status = 0;
        $messages = '添加失败';
        $rule=[
            "username"=>"require" ,
            "password"=>"require",
            "email"=>"require|email",
        ];
        $msg = [
            'username'=>'名称格式错误',
            "password"=>"密码格式错误",
            'email'=>'邮箱格式错误',
        ];
        $validate = new Validate($rule,$msg);
        $result=$validate->check($data);
//       $insterData=[
//           'username'=>$data["name"],
//           'email'=>$data['email'],
//       ];
        $messages=$validate->getError();
        $username=$this->request->param("username");
        $is_user=MemberModel::get(["username"=>$username]);
        if($is_user!=null){
            $status=0;
            $messages="用户名已存在";
        }
        if($data["password"]!=$data["password1"]){
            $status=0;
            $messages="密码不一致";
            $paw=false;
        }else{
            $paw=true;
        }

        if($result==true&$is_user==null&$paw==true){
            $password=$this->request->param("password");
            $data["password"]=md5($password);
            unset($data['password1']);

            $insterTrue=MemberModel::create($data);
            if($insterTrue!=null){
                $status=1;
                $messages="注册成功";
            }

        }
        return ['status'=>$status,'message'=>$messages];
    }
}
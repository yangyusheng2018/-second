<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/5
 * Time: 18:09
 */

namespace app\index\controller;
use think\Controller;
use think\Model;
use think\Request;
use app\index\model\User as UserModel;
use think\Db;
use think\Session;
use think\Validate;

class Login extends Controller
{
    public function login(){
        if(session('user_id')){
            $this->error("用户已经登录",url("/admin"));
        }
        return $this->fetch("user/login");
    }
    public function checkLogin(Request $request){
        $status=0;
        $result="";
        $data=$request->param();
        $rule=[
            'name'=>"require",
            'password'=>"require",
            'verify'=>"require|captcha",
        ];

        $result=$this->validate($data,$rule);
        $name=$data['name'];
        $password=md5($data['password']);
        if($result==1){



            $map=['name'=>$name,
                'password'=>$password,
            ];
            $map1=['name'=>$name,
                'password'=>$password,
                "status"=>1,
            ];
            $user=UserModel::get($map);
            $user1=UserModel::get($map1);
            if($user==null){
                $result="密码和账号不匹配或者用户不存在";

            }elseif($user1==null){


                $result="此管理员已被禁用";
            }else {
                $status = 1;
                $result = "登陆成功点击确定继续";
                Session::set("user_id", $user->id);
                Session::set("user_info", $user->getData());
                $user->setInc('login_count');

            }
        }


        return ['status'=>$status,'message'=>$result,'data'=>$data,];


    }

}
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/11
 * Time: 17:21
 */

namespace app\index\controller;
use app\index\controller\Base;
use app\index\model\Member as MemberModel;
use think\Model;
use think\Request;
use think\Db;
use think\Session;
use think\Validate;
use app\index\controller\Common;
class Member extends Base
{




        public function member_list(){
            $data=MemberModel::all();
            $count=Db::name("member")->count();
            $this->view->assign("title","会员列表");
            $this->view->assign("data",$data);
            $this->view->assign("count",$count);
            return $this->view->fetch();
        }



   public function edit_member(Request $request){
       $data=$this->request->param();
       $id=$this->request->param("id");

       $status = 0;
       $messages = '更新失败';
       $rule=[
           "username"=>"require" ,
           "email"=>"require|email",
       ];
       $msg = [
           'username'=>'名称格式错误',
           'email'=>'邮箱格式错误',
       ];
       $validate = new Validate($rule,$msg);
       $result=$validate->check($data);
//       $insterData=[
//           'username'=>$data["name"],
//           'email'=>$data['email'],
//       ];
       $messages=$validate->getError();
       if($result==true){
           $insterTrue=MemberModel::update($data,["id"=>$id]);
           if($insterTrue!=null){
               $status=1;
               $messages="更新成功";
           }

       }
       return ['status'=>$status,'message'=>$messages];
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

    public function member_show(Request $request){
            $id=$this->request->param("id");
            $user=MemberModel::get($id);
            $data=$user->getData();
            $sex=$user->sex;
            $this->view->assign("data",$data);
            $this->view->assign("sex",$sex);
            return $this->view->fetch();
    }
    public function password_edit(Request $request){
        $id=$this->request->param("id");
        $this->view->assign("id",$id);
        return $this->view->fetch();
    }
    public function edit_password(Request $request){
        $data=$this->request->param();
        $id=$this->request->param("id");
        $password=$this->request->param("password");
        $password1=$this->request->param("password1");
        $status = 0;
        $messages = '添加失败';
        $rule=[
            "password"=>"require",
            "password1"=>"require",
        ];
        $msg = [
            "password"=>"密码格式错误",
            "password1"=>"密码格式错误",
        ];
        $validate = new Validate($rule,$msg);
        $result=$validate->check($data);
        $messages=$validate->getError();

        if($password!=$password1){
            $result1=0;
            $messages="密码不一致";
        }else{
            $result1=1;
        }
        if($result==true&$result1==1){
            $password=md5($password);
            $insterTrue=MemberModel::update(["password"=>$password],["id"=>$id]);
            if($insterTrue!=null){
                $status=1;
                $messages="修改成功";
            }

        }
        return ['status'=>$status,'message'=>$messages];
    }


    public function unDelete(){
        MemberModel::update(["delete_time"=>null],["is_delete"=>1]);
    }
    public function delete_members(Request $request){

        $data=$request->param();
        var_dump($data);
        return ['status'=>1,'message'=>"1"];
    }

    public function member_del_list(){
            $data=MemberModel::all(["is_delete"=>1]);
        $count=count($data);
        $this->view->assign("title","已删除会员列表");
        $this->view->assign("list",$data);
        $this->view->assign("count",$count);
        return $this->view->fetch();
    }
    public function score_list(){
        $data=MemberModel::all();
        $count=count($data);
        $this->view->assign("title","会员积分列表");
        $this->view->assign("list",$data);
        $this->view->assign("count",$count);
        return $this->view->fetch();
    }
    public function score_edit(Request $request){
        $id=$this->request->param("id");
        $score=MemberModel::get("$id")->getData("score");
        $level_id=MemberModel::get("$id")->getData("level_id");
        $this->view->assign("id",$id);
        $this->view->assign("score",$score);
        $this->view->assign("level_id",$level_id);
        return $this->view->fetch();
    }
    public function edit_score(Request $request){
        $id=$this->request->param("id");
        $score=$this->request->param("score");
        $level_id=$this->request->param("level_id");
        $status = 0;
        $messages = '修改失败';
        $rule=[
            "score"=>"require|number",
            "score"=>"require|number",
        ];
        $msg = [
            "score"=>"积分格式错误",
            "score"=>"等级格式错误",
        ];
        $validate = new Validate($rule,$msg);
        $result=$validate->check(["score"=>$score]);
        $messages=$validate->getError();

        if($result==true){
            $insterTrue=MemberModel::update(["score"=>$score,"level_id"=>$level_id],["id"=>$id]);
            if($insterTrue!=null){
                $status=1;
                $messages="修改成功";
            }

        }
        return ['status'=>$status,'message'=>$messages];
    }
    public function selects(Request $request){
        $inputs=$request->param("inputs");
        $firstdate=$request->param("firstdate");
        $lastdate=$request->param("lastdate");
        $sex=$request->param("sex");
        $firstdate=strtotime($firstdate);
        $lastdate=strtotime($lastdate);
        $orders=new MemberModel();
        $where=[];$where1=[];$where3=[];$where4=[];
        if($firstdate!=""){
            $where["create_time"]=[">=",$firstdate];
        }
        if($sex!=""){
            $where["sex"]=['eq',$sex];
        }
        if($lastdate!=""){
            $where["create_time"]=["<=",$lastdate];
        }
        if($inputs!=""){
            $where1["id"]=['eq',$inputs];
            $where1["username"]=["like",'%'.$inputs.'%'];
            $where1["name"]=["like",'%'.$inputs.'%'];
            $where1["phone"]=['eq',$inputs];
            $where1["email"]=['eq',$inputs];
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

        $goodsList=$res;

        $this->view->assign("count",$counts);

        if($goodsList){
            $this->view->assign("data",$goodsList);
            return $this->view->fetch("member_list");
        }else{
            return $this->view->fetch("/index/nores");
        }


    }

}
<?php
/**
 * Created by PhpStorm.
 * User: yang
 * Date: 2018/8/21
 * Time: 19:41
 *  $mes=[
'name'=>[ "require"=>'用户名不能为空，请检查'],
'password'=>[ "require"=>'密码不能为空，请检查'],
'verify'=>[ "require"=>'验证码不能为空，请检查',
"captche"=>'验证码不正确，请检查'],
];
 */

namespace app\index\controller;
use app\index\controller\Base;
use think\Model;
use think\Request;
use app\index\model\User as UserModel;
use think\Db;
use think\Session;
use think\Validate;
class User extends Base
{



    public function logout(){
            Session::delete("user_id");
            Session::delete("user_info");
            $this->success("退出成功","user/login");
    }

    /**
     * @return array
     */
    public function admin_list(){
        
        $this->view->count=UserModel::count();
        $this->view->assign("title","管理员列表");
        $this->view->assign("keywords","学生管理系统");
        $this->view->assign("description","thinkphp5实例开发");
        $username=Session::get("user_info.name");
        if($username=="admin"){
            $users=UserModel::all();

        }else{
            $users=UserModel::all(["name" => $username]);
        }
        $this->view->assign("users",$users);
        return $this->view->fetch();

    }
    public function setStatus(Request $request){
         
        $user_id=$request->param("id");
        $result=UserModel::get($user_id);
        if($result->getData("status")==1){
            UserModel::update(["status"=>0],["id"=>$user_id]);
        }else{
            UserModel::update(["status"=>1],["id"=>$user_id]);
        }
    }
    public function delete_user(Request $request){

        $user_id=$request->param("id");
        UserModel::update(["is_delete"=>1],["id"=>$user_id]);
        UserModel::destroy($user_id);
        $this->redirect('index/user/admin_list');
    }
    public function unDelete(){

        UserModel::update(["delete_time"=>null],["is_delete"=>1]);
    }
    public function admin_add(){

        return $this->fetch();
    }
    public function checkUserName(){
    $userName=trim($this->request->param("name"));
    $users=UserModel::get(["name"=>$userName]);
    $status=1;
    $messages="";
    if($users!=null){
        $status=0;
        $messages="用户名已经被使用";
    }
    if($userName==""){
        $status=0;
        $messages="用户名不能为空";
    }
    return ['status'=>$status,'message'=>$messages];
}

    public function checkUserName1(){
        $userName=trim($this->request->param("name"));
        $id=$this->request->param("id");
        $name1=UserModel::get(["id"=>$id])->getData("name");
        $users=UserModel::get(["name"=>$userName]);
        $status=1;
        $messages="";
        if($users!=null&$name1!=$userName){
            $status=0;
            $messages="用户名已经被使用";
        }
        if($userName==""){
            $status=0;
            $messages="用户名不能为空";
        }
        return ['status'=>$status,'message'=>$messages];
    }

    public function checkUserEmail(){
        $userEmail=trim($this->request->param("email"));
        $users=UserModel::get(["email"=>$userEmail]);
        $status=1;
        $messages="";
        if($users!=null){
            $status=0;
            $messages="邮箱已经被使用";
        }
        if($userEmail==""){
            $status=0;
            $messages="邮箱不能为空";
        }
        return ['status'=>$status,'message'=>$messages];
    }
    public function checkUserEmail1(){
        $userEmail=trim($this->request->param("email"));
        $id=$this->request->param("id");
        $email1=UserModel::get(["id"=>$id])->getData("email");
        $users=UserModel::get(["email"=>$userEmail]);
        $status=1;
        $messages="";
        if($users!=null&$email1!=$userEmail){
            $status=0;
            $messages="邮箱已经被使用";
        }
        if($userEmail==""){
            $status=0;
            $messages="邮箱不能为空";
        }
        return ['status'=>$status,'message'=>$messages];
    }



    public function add_admin(Request $request){
        $data=$request->param();
            $ch_name=$this->checkUserName();
            $ch_pass=$this->checkPassWord();
            $ch_email=$this->checkUserEmail();

        $status = 0;
        $messages = '添加失败';
        $rule=[
            "name"=>"require" ,
            "password"=>"require",
            "email"=>"require|email",
        ];
        $msg = [
            'name'=>'名称格式错误',
            'password'=>'密码格式错误',
            'email'=>'邮箱格式错误',
        ];
        $validate = new Validate($rule,$msg);
        $result=$validate->check($data);
        $insterData=[
        'name'=>$data["name"],
        'password'=>md5($data['password']),
        'email'=>$data['email'],
        'role'=>$data['role'],
            "status"=>1,
        ];


        $messages=$validate->getError();
        if($ch_name["status"]==0){$messages=$ch_name["message"];}
        if($ch_pass["status"]==0){$messages=$ch_pass["message"];}
        if($ch_email["status"]==0){$messages=$ch_email["message"];}

        if($result==true&$ch_name["status"]==1&$ch_pass["status"]==1&$ch_email["status"]==1){
            $insterTrue=UserModel::create($insterData);
            if($insterTrue!=null){
                $status=1;
                $messages="添加成功";
            }

        }
    return ['status'=>$status,'message'=>$messages];
    }
    public function checkPassWord(){
        $password=trim($this->request->param("password"));
        $password2=trim($this->request->param("password2"));
        $status=1;
        $messages="";
        if($password!=$password2){
            $status=0;
            $messages="密码不一致";
        }
        if($password==""|$password2==""){
            $status=0;
            $messages="密码不能为空";
        }
        return ['status'=>$status,'message'=>$messages];
    }
    public function admin_edit(Request $request){
       
        $id=$this->request->param('id');
        $user=UserModel::get($id);
        //var_dump($user);
        $user_info=$user->getData();
        $name=$user->getData('name');
        $password=$user->getData('password');
        $email=$user->getData('email');
        $this->view->assign('name',$name);
        $this->view->assign('password',md5($password));
        $this->view->assign('email',$email);
        $this->view->assign('id',$id);
        $this->view->assign('user_info',$user_info);
       return $this->view->fetch();
        //var_dump($name);
    }

    public function edit_admin(Request $request){
        
        $data=$this->request->param();
        $ch_name=$this->checkUserName1();
        $ch_pass=$this->checkPassWord();
        $ch_email=$this->checkUserEmail1();

        $status = 0;
        $messages = '添加失败';
        $id=$this->request->param("id");
        $rule=[
            "name"=>"require" ,
            "password"=>"require",
            "email"=>"require|email",
        ];
        $msg = [
            'name'=>'名称格式错误',
            'password'=>'密码格式错误',
            'email'=>'邮箱格式错误',
        ];
        $validate = new Validate($rule,$msg);
        $result=$validate->check($data);
        $insterData=[
            'name'=>$data["name"],
            'password'=>md5($data['password']),
            'email'=>$data['email'],
        ];
        $user_info_name=Session::get("user_info.name");
        if($user_info_name=="admin"){
           $insterData["role"]=$data["role"];
        }
        $messages=$validate->getError();
        if($ch_name["status"]==0){$messages=$ch_name["message"];}
        if($ch_pass["status"]==0){$messages=$ch_pass["message"];}
        if($ch_email["status"]==0){$messages=$ch_email["message"];}

        if($result==true&$ch_name["status"]==1&$ch_pass["status"]==1&$ch_email["status"]==1){
            $insterTrue=UserModel::update($insterData,["id"=>$id]);
            if($insterTrue!=null){
                $status=1;
                $messages="更新成功";
            }

        }
        return ['status'=>$status,'message'=>$messages];
    }
        public function user_alldelete(){
            
        $ids=input("post.delete_id/a");
        foreach ($ids as $id){
            UserModel::update(["is_delete"=>1],["id"=>$id]);
            UserModel::destroy($id);
        }
        return ['status'=>1,'message'=>"删除成功"];
    }
}
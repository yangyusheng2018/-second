<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/19
 * Time: 19:15
 */

namespace app\home\controller;

use app\home\controller\Base;
use app\index\model\Comment as CommentModel;
use think\Model;
use think\Request;
use think\Session;

class Comment extends Base
{
    public function _initialize()
    {
        if(!session('member_id')){
            $this->error("用户未登录",url("/home/member/login"));
        }
    }
    function add_comment(Request $request){
        $status=0;
        $messages="请登录后再评论";
        $member_id=Session::get("member_id");
        $data=$this->request->param();

        if(empty($member_id)){
            $status=0;
            $messages="请登录后再评论";
        }else{
            $data["member_id"]=$member_id;
            unset($data["name"]);
            unset($data["password"]);
            $is_insert=CommentModel::create($data);
            if($is_insert){
                $status=1;
                $messages="评论成功";
            }else{
                $status=0;
                $messages=$this->error($is_insert);
            }

        }

        return ["message"=>$messages,"status"=>$status];
    }

}
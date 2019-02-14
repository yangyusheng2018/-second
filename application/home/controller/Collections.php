<?php
/**
 * Created by PhpStorm.
 * User: yang
 * Date: 2018/10/21
 * Time: 22:56
 */

namespace app\home\controller;

use app\home\controller\Base;
use app\home\model\Collections as CollectionsModel;
use think\Request;
use think\Session;

class Collections extends Base
{


    public function add_collections(Request $request){
        $goods_id=$this->request->param("id");
        $member_id=Session::get('member_id');
            if(!empty($member_id)){
                $isset_goods=CollectionsModel::get(["member_id"=>$member_id,"goods_id"=>$goods_id]);
                if(empty($isset_goods)){
                    $add=CollectionsModel::create(["member_id"=>$member_id,"goods_id"=>$goods_id]);
                }
            }else{
                    session("collections.$goods_id",$goods_id);
            }
        }


}
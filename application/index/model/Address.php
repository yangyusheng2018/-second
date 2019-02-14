<?php
/**
 * Created by PhpStorm.
 * User: yang
 * Date: 2018/10/23
 * Time: 0:07
 */

namespace app\index\model;


use think\Model;
use think\Request;
use traits\model\SoftDelete;
use think\Validate;
class Address extends Model
{
    use SoftDelete;
    protected $deleteTime="delete_time";
    protected $auto=[

    ];
    protected $insert=[

        "is_delete"=>0,
    ];
    protected $update=[];
    protected $autoWriteTimestamp=true;
    protected $createTime="create_time";
    protected $updateTime="update_time";
    protected $dateFormat="Y-m-d";

    public function member(){
        return $this->belongsTo("member");
    }
    public function member_address($member_id){
        $addressmodel=new Address();
        $address=$addressmodel->where(["member_id"=>$member_id])->select();
        if($address==null){
            return false;
        }else{
            return $address;
        }

    }
    public function order_address($member_id){
        $address=$this->member_address($member_id);
        if($address==false){
            return false;
        }else{
            $order_address=[];
            foreach ($address as $vv){
                $data=[
                    "name"=>$vv["name"],
                    "code"=>$vv->code,
                    "phone"=>$vv->phone,
                    "id"=>$vv->id,
                    "address"=>$vv["name"].",".$vv->privince.",".$vv->district.",".$vv->address.",".$vv->code.",".$vv->phone,
                ];
                $order_address[]=$data;
            }
            return $order_address;
        }

    }

    public function validates($data){
        $rule=[
            "name"=>"require" ,
            "privince"=>"require",
            "district"=>"require" ,
            "address"=>"require" ,
            "code"=>"require|number" ,
            "phone"=>"require|number" ,
        ];
        $msg = [
            "name"=>"姓名不能为空" ,
            "privince"=>"省份不能为空",
            "district"=>"市/区不能为空" ,
            "address"=>"详细地址不能为空" ,
            "code"=>"邮编必须是数字" ,
            "phone"=>"手机号不合法" ,
        ];
        $validate = new Validate($rule,$msg);
        $result=$validate->check($data);

        $messages=$validate->getError();
        return ["result"=>$result,"messages"=>$messages];
    }



}
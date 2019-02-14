<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/27
 * Time: 16:27
 */

namespace app\index\model;

use think\Model;
use think\Db;
use traits\model\SoftDelete;
use app\index\model\Goods;
class Order extends Model
{
    use SoftDelete;
    protected $deleteTime="delete_time";
    protected $auto=[


    ];
    protected $insert=[
        "is_delete"=>0,
        "delete_time"=>null,
        "status"=>1,
        "is_pay"=>0,
    ];
    protected $update=[];
    protected $autoWriteTimestamp=true;
    protected $createTime="create_time";
    protected $updateTime="update_time";
    protected $dateFormat="Y-m-d";

    public function getStatusAttr($valus){
        $status=[
            0=>"已禁用",
            1=>"已启用",
        ];
        return $status[$valus];
    }
    public function getPaymentAttr($valus){
        $payment=[
            1=>"支付宝",
            2=>"微信",
            3=>"网银",
            4=>"信用卡",
            5=>"账户余额",
            6=>"到付",
        ];
        return $payment[$valus];
    }
    public function getDeliveryAttr($valus){
        $delivery=[
            1=>"申通",
            2=>"圆通",
        ];
        return $delivery[$valus];
    }

    public function getCreateTimeAttr($valus){
        return date("Y-m-d h:m:s",$valus);
    }
    public function member(){
        return $this->belongsTo("member");
    }
    public function address(){
        return $this->belongsTo("address");
    }
    public function order_detail($data){
            $goods_id=explode(",",$data["goods_ids"]);
            $number=explode(",",$data["numbers"]);
        $goodsdatas=[];
            foreach ($goods_id as $key=>$vv){
               $goods=Goods::get($vv);
               $goodsdata=[
                   "number"=>$number[$key],
                   "goods_name"=>$goods["goods_name"],
                   "price"=>$goods["saleprice"]*$goods["discount"]*0.1,
                   "imageurl"=>$goods["imageurl"],
               ];
                $goodsdatas[]=$goodsdata;
            }
            return $goodsdatas;
    }

    public function foreachedata($res){
        $goodsList=[];
        foreach ($res as $value){
            if(isset($value->address->id)){
                $privince=$value->address->privince;
                $district=$value->address->district;
                $address=$value->address->address;
                $code=$value->address->code;
                $phone=$value->address->phone;
                $name=$value->address->name;
                $addr=$privince."|".$district."|".$address."|".$code."|".$phone."|".$name;
            }
            $data=[

                "id"=>$value->id,
                "is_pay"=>$value->is_pay,
                "member_id"=>$value->member_id,
                'payment' => $value->payment,
                'delivery' => $value->delivery,
                'total' => $value->total,
                'create_time' => $value->create_time,
                "name"=>isset($value->member->username)? $value->member->username:"未分类",
                "address"=>isset($value->address->id)? $addr:"未分类",
            ];
            $goodsList[] = $data;
        }
        return $goodsList;
    }

}
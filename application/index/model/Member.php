<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/11
 * Time: 17:15
 */

namespace app\index\model;
use think\Model;
use traits\model\SoftDelete;
class Member extends Model
{
    use SoftDelete;
    protected $deleteTime="delete_time";
    protected $auto=[


    ];
    protected $insert=[
        "login_time"=>null,
        "login_count"=>0,
        "status"=>1,
        "is_delete"=>0,
    ];
    protected $update=[];
    protected $autoWriteTimestamp=true;
    protected $createTime="create_time";
    protected $updateTime="update_time";
    protected $dateFormat="Y-m-d";
    public function getSexAttr($value){
        $sex=[
            1=>'男',
            0=>'女',
            2=>'保密',
        ];
        return $sex[$value];
    }
    public function getStatusAttr($value)
    {
        $status=[
            1=>"启用",
            0=>"禁用",
        ];
        return $status[$value];
    }
    public function getLevelIdAttr($value)
    {
        $level_id=[
            0=>"青铜会员",
            null=>"青铜会员",
            1=>"白银会员",
            2=>"黄金会员",
            3=>"钻石会员",
        ];
        return $level_id[$value];
    }
    public function getLoginTimeAttr($valus){
        return date("Y-m-d h:i:s",$valus);
    }
    public function order()
    {
       return $this->hasMany("order");
    }
    public function address()
    {
        return $this->hasMany("address");
    }
    public function comment(){
        return $this->hasMany("comment");
    }
}
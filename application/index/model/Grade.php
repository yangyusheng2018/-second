<?php
/**
 * Created by PhpStorm.
 * User: yang
 * Date: 2018/8/30
 * Time: 19:58
 */

namespace app\index\model;

use think\Model;
use traits\model\SoftDelete;
class Grade extends Model
{
    use SoftDelete;
    protected $dateFormat="Y/M/D";
    protected $createTime="create_time";
    protected $updateTime="update_time";
    protected $deleteTime="delete_time";
    protected $autoWriteTimestamp="true";
    protected $insert=["status"=>1];
    protected $update=[];
    protected $auto=[
        "delete_time"=>null,
        "is_delete"=>0,
    ];
    public function getStatusAttr($value)
    {
       $status=[
        0=>"禁用",
        1=>"启用"];
        return $status[$value];
    }
    public function teacher(){
        return $this->hasOne("Teacher");
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: yang
 * Date: 2018/9/16
 * Time: 19:29
 */

namespace app\index\model;

use think\Model;
use think\Db;
use traits\model\SoftDelete;
class Brand extends Model
{
    use SoftDelete;
    protected $deleteTime="delete_time";
    protected $auto=[


    ];
    protected $insert=[
        "is_delete"=>0,
        "delete_time"=>null,
        "status"=>1,
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

    public function getCreateTimeAttr($valus){
        return date("Y-m-d",$valus);
    }
    public function goods(){
        return $this->hasMany("goods");
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/28
 * Time: 16:56
 */

namespace app\index\model;

use think\Model;
use traits\model\SoftDelete;
class Comment extends Model
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
//    public function getScoreAttr($valus){
//        $score=[
//            1=>"一星", 2=>"一星", 3=>"三星", 4=>"四星", 5=>"五星",
//        ];
//        return $score[$valus];
//    }

    public function getCreateTimeAttr($valus){
        return date("Y-m-d h:m:s",$valus);
    }
    public function member(){
        return $this->belongsTo("member");
    }
    public function goods(){
        return $this->belongsTo("goods");
    }
}
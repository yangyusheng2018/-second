<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/13
 * Time: 11:27
 */

namespace app\index\model;

use think\Model;
use think\Db;
use traits\model\SoftDelete;
use app\index\model\Comment;
class Goods extends Model
{
    use SoftDelete;
    protected $deleteTime="delete_time";
    protected $auto=[


    ];
    protected $insert=[
        "is_delete"=>0,
        "delete_time"=>null,
        "is_review"=>0,
    ];
    protected $update=[];
    protected $autoWriteTimestamp=true;
    protected $createTime="create_time";
    protected $updateTime="update_time";
    protected $dateFormat="Y-m-d";

    public function getStatusAttr($valus){
        $status=[
            0=>"已下架",
            1=>"已上架",
        ];
        return $status[$valus];
    }
    public function getIsReview($valus){
        $is_review=[
            0=>"未审核",
            1=>"已审核",
        ];
        return $is_review[$valus];
    }


    public function getAddtimeAttr($valus){
        return date("Y-m-d",$valus);
    }
    public function getStartTimeAttr($valus){
        return date("Y-m-d",$valus);
    }
    public function getEndTimeAttr($valus){
        return date("Y-m-d",$valus);
    }
   public function cate(){
        return $this->belongsTo("cate");
   }
    public function brand(){
        return $this->belongsTo("brand");
    }

    public function comment(){
        return $this->hasMany("comment");
    }


}
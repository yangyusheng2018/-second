<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/19
 * Time: 9:42
 */

namespace app\index\model;

use think\Model;
use think\Db;
use think\Request;
use traits\model\SoftDelete;
use app\index\model\Goods;
class Cate extends Model
{
    use SoftDelete;
    protected $deleteTime="delete_time";
    protected $auto=[


    ];
    protected $insert=[
        "is_delete"=>0,
        "delete_time"=>null,
    ];
    protected $update=[];
    protected $autoWriteTimestamp=true;
    protected $createTime="create_time";
    protected $updateTime="update_time";
    protected $dateFormat="Y-m-d";

    public function getAllData(){
        $data=$this->select();
        return $this->resort($data);
    }
    public function resort($data,$pid=0){
        static $arrays=array();
        foreach ($data as $k=>$v){
                if($v["pid"]==$pid){
                    $arrays[$k]=$v;
                    $this->resort($data,$v["id"]);
                }
        }
            return $arrays;
    }

    public function redelete($data,$id){
        foreach ($data as $k=>$v){
            if($v["pid"]==$id){
                $sdata=Cate::get(["pid"=>$v["pid"]]);
                $sid=$sdata->getData("id");

                Cate::update(["is_delete"=>1],["id"=>$v["pid"]]);
                Cate::destroy($v["pid"]);
                $this->resort($data,$sid);
            }
        }
    }

//    public function getcatedata($id){
//        $alldata=Cate::all();
//        foreach ($alldata as $k=>$all){
//            foreach ($data as $v){
//                if($v["id"]==$all["pid"]){
//                    $this->getcatedata($all["id"]);
//                }
//            }
//
//
//        }
//
//    }

    public function rekeys($pid=0){
        $data=Cate::all();
        static $arrays=array();
        foreach ($data as $v){
            if($v["pid"]==$pid){
                $arrays[]=$v["id"];
                $this->rekeys($v["id"]);
            }
        }
        return $arrays;
    }
    public function getcatedatas($id){
        $goodsmodel=new Goods();
        $arrays=$this->rekeys($id);
        $arrays[]=$id;
//        foreach ($arrays as $v){
//            $catedata=$goodsmodel->where(["cate_id"=>$v])->select();
//            $catedatas=array_merge($catedatas,$catedata);
//        }
        $map["cate_id"]=["in",$arrays];
        $catedatas=$goodsmodel->where($map)->paginate(3);


        return $catedatas;
    }




    public function goods(){
        return $this->hasMany("goods");
    }

}
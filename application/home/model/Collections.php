<?php
/**
 * Created by PhpStorm.
 * User: yang
 * Date: 2018/10/21
 * Time: 22:42
 */

namespace app\home\model;


use think\Model;

class Collections extends Model
{

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
    public function goods(){
        return $this->belongsTo("goods");
    }

}
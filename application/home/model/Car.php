<?php
/**
 * Created by PhpStorm.
 * User: yang
 * Date: 2018/10/16
 * Time: 0:20
 */

namespace app\home\model;

use think\Model;
use traits\model\SoftDelete;

class Car extends Model
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
    public function goods(){
        return $this->belongsTo("goods");
    }

}
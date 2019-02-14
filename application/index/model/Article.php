<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/16
 * Time: 9:33
 */

namespace app\index\model;

use think\Model;
use think\Request;
use traits\model\SoftDelete;
use think\Validate;
class Article extends Model
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
    public function getCreateTimeAttr($valus){
        return date("Y-m-d",$valus);
    }
}
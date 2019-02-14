<?php
/**
 * Created by PhpStorm.
 * User: yang
 * Date: 2018/8/16
 * Time: 0:01
 */

namespace app\index\controller;

use app\index\controller\Base;
use org\Upload;
use think\Request;
use think\File;
use think\Image;
class Index extends Base
{
public function index(){


    return $this->view->fetch();
}
    public function test(){
        return $this->view->fetch();

    }
//    public function test1(Request $request){
//        $files=$request->file("img");
//
//var_dump($files);
//        $dir="upload/brand/";// 自定义文件上传路径
//        if(!is_dir($dir)){
//
//            mkdir($dir,0777,true);
//
//        }
//        foreach($files as $picFile){
//            $info = $picFile->move($dir);
//
//        }
//
//
//
//    }

    public function test1(Request $request)
    {


        $scr = $request->file("file-Portrait1");

        var_dump($scr);
//        $dir = "upload/brand";
//
//        $scr->move($dir);


    }
    public function test2(Request $request)
    {

        $scr = $request->file("file-Portrait1");
        $dir = "upload/brand";

        $scr->move($dir);


    }


//    public function test2(Request $request){
//        $scr=$request->file("scr");
//        $dir="upload/brand/";
//        foreach($scr as $picFile){
//           $picFile->move($dir);
//
//        }
//    }


}
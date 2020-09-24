<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    /**
     * 保存图片
     *
     * @return void
     */
    public function SaveImage()
    {
        $path = '../public/uploadfile/';
        # code...
        $file = $this->request->file('file');
        $info = $file->validate(['ext'=>'jpg,png,gif'])->move($path);
        var_dump($info);die;
        if($info){
            // 成功上传后 获取上传信息
            // 输出 jpg
            // echo $info->getExtension();
            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
            // echo $info->getSaveName();
            // 输出 42a79759f284b767dfcb2a0197904287.jpg
            // echo $info->getFilename(); 
            return json(['state'=>1, 'url'=> $path.$info->getSaveName(), 'title'=>$info->getFilename(), 'type'=>$info->getExtension()]);
        }else{
            // 上传失败获取错误信息
            // echo $file->getError();
            return json(['state'=>0, 'msg'=> $file->getError()]);
        }
        
    }

    /**
     * 替换图片
     */

    public function tupian()
    {
        # code...
        return $this->fetch();
    }

}

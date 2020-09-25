<?php
namespace app\index\controller;

use think\Controller;
use think\Cookie;
use app\index\model\RoleModel;

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
        $cookie_flag = Cookie::get('PHPSESSID');
        $ip_flag = get_client_ip();

        # code...
        $file = $this->request->file('file');
        $file_name = input("post.name",'');
        $info = $file->validate(['ext'=>'jpg,png,gif'])->move($path);
        if($info){
            // 成功上传后 获取上传信息
            // 输出 jpg
            // echo $info->getExtension();
            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
            // echo $info->getSaveName();
            // 输出 42a79759f284b767dfcb2a0197904287.jpg
            // echo $info->getFilename(); 

            $data['cookie'] = $cookie_flag;
            $data['ip'] = $ip_flag;
            $data['img_path'] = 'public/uploadfile/'.$info->getSaveName();
            $data['img_name'] = $file_name;
            $data['type'] = 0;

            return json(['state'=>1, 'url'=> $path.$info->getSaveName(), 'title'=>$info->getFilename(), 'type'=>$info->getExtension()]);
        }else{
            // 上传失败获取错误信息
            // echo $file->getError();
            return json(['state'=>0, 'msg'=> $file->getError()]);
        }
        
    }

    /**
     * 替换图片背景
     */

    public function tupian()
    {
        # code...
        return $this->fetch();
    }

}

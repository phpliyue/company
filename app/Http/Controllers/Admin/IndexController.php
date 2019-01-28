<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends controller
{
    /*
    *后台首页
    */
    public function index()
    {
        // 定义一个 xml
        $message = <<<MESSAGE
<xml>
    <ToUserName><![CDATA[gh_6541541b6a5b]]></ToUserName>
    <FromUserName><![CDATA[oqEyo1MxM6Xfyo2cRu9KdglK5uEs]]></FromUserName>
    <CreateTime>1401495511</CreateTime>
    <MsgType><![CDATA[text]]></MsgType>
    <Content><![CDATA[我是咔咔]]></Content>
    <MsgId>1235567891123956</MsgId>
</xml>
MESSAGE;
//        MESSAGE;
        // 把 xml 数据转换成 PHP 的对象
        $postObj = simplexml_load_string($message, 'SimpleXMLElement', LIBXML_NOCDATA);
        $toUser = $postObj->FromUserName;
        $fromUser = $postObj->ToUserName;
        if(strtolower($postObj->MsgType) == 'text'){
            $content = $postObj->Content;
            $temp = $this->getXML($fromUser,$toUser,$content);
            dd($temp);
        }
        return view('admin.index');
    }

    public function getXML($FromUserName,$ToUserName,$content)
    {
        $tpl = "<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%d</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[%s]]></Content></xml>";
        $temp = sprintf($tpl,$FromUserName,$ToUserName,time(),$content);
        return $temp;
    }

}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WxtoolController extends Controller
{
    /**
     * 微信服务号回调验证
     */
    public function index(Request $request){
        $signature = $request->input('signature');
        $timestamp = $request->input('timestamp');
        $echostr = $request->input('echostr');
        $nonce = $request->input('nonce');
        $token = '';
        $array = array($token,$nonce,$timestamp);
        sort($array);
        $hashcode = sha1(implode('', $array));
        if($hashcode == $signature && $echostr){
            echo $echostr;//微信回调验证
            exit;
        }else{
            $this->assWeChat();//用户事件
        }
    }
    /**
     * 关注服务号事件
     */
    protected function assWeChat(){
        $data = file_get_contents('php://input');
        $obj = simplexml_load_string($data);
        $FromUserName = $obj->FromUserName;
        $ToUserName = $obj->ToUserName;
        $EventKey = $obj->EventKey; //获取场景ID
        if(strtolower($obj->MsgType)=='event'){//事件
            if(strtolower($obj->Event)=='subscribe' || strtolower($obj->Event)=='scan'){//关注事件
                $shop_code = trim($EventKey,'qrscene_B');
                $unionId = $this->getUserUnionId($FromUserName);//获取用户  unionId
                $content = '欢迎来到雪球社区！！！';
                $temp =  $this->getXML($FromUserName,$ToUserName,$content);//XML回复微信服务号
                echo $temp;
            };
        }
    }

    /**
     * 回调xml文件模版
     */
    public function getXML($FromUserName,$ToUserName,$content){
        $tpl = "<xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%d</CreateTime>
                <MsgType><![CDATA[text]]></MsgType>
                <Content><![CDATA[%s]]></Content>
                </xml>";
        $temp = sprintf($tpl,$FromUserName,$ToUserName,time(),$content);
        return $temp;
    }

    /**
     * 设置公众号底部导航o
     */
    public function setFooterButton(){
        $access_token = $this->getWxAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
        $data = '{
            "button": [
                {
                    "type": "miniprogram",
                    "name": "附近好店小程序",
                    "url": "https://www.menkouhaodian.com",
                    "appid": "wxae25568b6c321390",
                    "pagepath": "pages/index/index"
                },
                {
                    "type": "click",
                    "name": "小助手",
                    "sub_button": [
                        {
                           "type":"click",
                           "name":"排行榜",
                           "key":"V1001_RANKINGLIST"
                        },
                         {
                           "type":"view",
                           "name":"APP下载",
                           "url":"http://a.app.qq.com/o/simple.jsp?pkgname=com.renwumeng.haodian"
                        },
                        {
                           "type":"click",
                           "name":"我的二维码",
                           "key":"V1001_MYCODE"
                        },
                   ]
                }
            ]
        }';
        $this->http_post_curl($url,$data);
    }
}

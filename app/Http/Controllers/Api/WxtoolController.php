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
        $token = config('wx.Token');
        $array = array($token,$nonce,$timestamp);
        sort($array);
        $hashcode = sha1(implode('', $array));
        if($hashcode == $signature && $echostr){
            return $echostr;//微信回调验证
        }else{
            return false;
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
//                $unionId = $this->getUserUnionId($FromUserName);//获取用户  unionId
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
     * 获取 wxcool_access_token
     * 返回json格式   $access_token 512字符   expires_in：有效期  7200   默认两小时
     */
    public function getWxAccessToken(){
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".config('wx.AppID')."&secret=".config('wx.AppSecret');
        $obj = file_get_contents($url);
        $obj = json_decode($obj,true);
        return $obj['access_token'];
    }

    /**
     * 设置公众号底部导航
     */
    public function setFooterButton(){
        echo phpinfo();die;
        dd(curl_init());
        $access_token = $this->getWxAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
        $data = '{
            "button": [
                {
                    "type": "miniprogram",
                    "name": "雪球社区",
                    "url": "https://www.msqlx.com",
                    "appid": "wx943a69cda83ce6f6",
                    "pagepath": "pages/index/index"
                },
                {
                    "type": "click",
                    "name": "热门服务",
                    "sub_button": [
                         {
                           "type":"view",
                           "name":"社区入驻",
                           "url":""
                         }，
                         {
                           "type":"view",
                           "name":"商家入驻",
                           "url":""
                         }，
                         {
                           "type":"view",
                           "name":"旅游入驻",
                           "url":""
                         }
                    ]
                }
                {
                    "type": "click",
                    "name": "关于我们",
                    "sub_button": [
                         {
                           "type":"view",
                           "name":"问题反馈",
                           "url":""
                         }，
                         {
                           "type":"view",
                           "name":"帮助中心",
                           "url":""
                         }，
                         {
                           "type":"view",
                           "name":"联系我们",
                           "url":""
                         }，
                         {
                           "type":"view",
                           "name":"广告合作",
                           "url":""
                         }
                    ]
                }
            ]
        }';
        $this->http_post_curl($url,$data);
    }

    /**
     * curl post 请求
     * 参数 $url：微信公众号各接口地址  data 数据参数
     * 返回 obj
     */
    private function http_post_curl($url,$data){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $output = curl_exec($ch);
        curl_close($ch);
        if($output !== FALSE ){
            $obj = json_decode($output);
            return $obj;
        }else{
            return false;
        }
    }
}

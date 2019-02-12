<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class WxtoolController extends Controller
{

    /**
     * 微信服务号回调验证
     */
    public function index()
    {
        $signature = isset($_GET["signature"]) ? $_GET["signature"] : '';
        $timestamp = isset($_GET["timestamp"]) ? $_GET["timestamp"] : '';
        $echostr = isset($_GET["echostr"]) ? $_GET["echostr"] : '';
        $nonce = isset($_GET["nonce"]) ? $_GET["nonce"] : '';
        $token = config('wx.Token');
        $array = array($token, $nonce, $timestamp);
        sort($array);
        $hashcode = sha1(implode('', $array));
        if ($hashcode == $signature && $echostr) {
            echo $echostr;//微信回调验证
            exit;
        } else {
            $this->reponseMsg();//用户事件
        }
    }

    /**
     * 接收事件推送并回复
     */
    public function reponseMsg()
    {
        //1.获取到微信推送过来post数据（xml格式）
        $postArr = file_get_contents("php://input");
        //2.处理消息类型，并设置回复类型和内容
        $postObj = simplexml_load_string($postArr, 'SimpleXMLElement', LIBXML_NOCDATA);
        $toUser = $postObj->FromUserName;
        $fromUser = $postObj->ToUserName;
        //判断该数据包是否是订阅的事件推送
        if (strtolower($postObj->MsgType) == 'event') {
            //如果是关注 subscribe 事件
            switch (strtolower($postObj->Event)) {
                case "subscribe"://订阅事件
                    $content = '欢迎关注雪球社区';
                    $toUser = 'oqEyo1MxM6Xfyo2cRu9KdglK5uEs';
                    $data['openid'] = $toUser;
                    $data['subscribe_time'] = time();
                    $data['unsubscribe_time'] = 0;
                    $data['status'] = 0;
                    $info = DB::table('snow_wxuser')->where('openid',$toUser)->first();
                    if(!empty($info)){
                        DB::table('snow_wxuser')->where('openid',$toUser)->update($data);
                    }else{
                        DB::table('snow_wxuser')->insert($data);
                    }
                    break;
                case "unsubscribe"://订阅事件
                    $content = '真舍不得您的离开';
                    $info = DB::table('snow_wxuser')->where('openid',$toUser)->first();
                    if(!empty($info)){
                        $data['unsubscribe_time'] = time();
                        $data['status'] = 1;
                        DB::table('snow_wxuser')->where('openid',$toUser)->update($data);
                    }
                    break;
                case "click"://点击菜单
                    //获取key
                    $key = $postObj->EventKey;
                    if ($key == 'SNOW') {
                        $content = '欢迎来到雪球社区';
                    }
                    break;
                default:
                    $content = '欢迎关注雪球社区';
                    break;
            }
            //回复用户消息(纯文本格式)
            $temp = $this->getXML($toUser, $fromUser, $content);
            echo $temp;
        }
        if (strtolower($postObj->MsgType) == 'text') {
            //回复用户消息(纯文本格式)
            $content = trim($postObj->Content);
            $temp = $this->getXML($toUser, $fromUser, $content);
            echo $temp;
        }
    }

    /**
     * 回调xml文件模版
     */
    public function getXML($toUser, $fromUser, $content)
    {
        $tpl = "<xml>
                  <ToUserName><![CDATA[%s]]></ToUserName>
                  <FromUserName><![CDATA[%s]]></FromUserName>
                  <CreateTime>%d</CreateTime>
                  <MsgType><![CDATA[text]]></MsgType>
                 <Content><![CDATA[%s]]></Content>
                </xml>";
        $temp = sprintf($tpl, $toUser, $fromUser, time(), $content);
        return $temp;
    }

    /**
     * 获取 wxcool_access_token
     * 返回json格式   $access_token 512字符   expires_in：有效期  7200   默认两小时
     */
    public function getWxAccessToken()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . config('wx.AppID') . "&secret=" . config('wx.AppSecret');
        $obj = file_get_contents($url);
        $obj = json_decode($obj, true);
        return $obj['access_token'];
    }

    /**
     * 获取用户UnionId
     * 参数  access_token    open_id
     * return $unionid  用户unionid
     */
    private function getUserUnionId($open_id = '')
    {
        $access_token = $this->getWxAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=" . $access_token . "&openid=" . $open_id . "&lang=zh_CN";
        $obj = $this->http_get_curl($url);
        $unionid = "";
        if ($obj) {
            $unionid = $obj->unionid;
        };
        return $unionid;
    }

    /**
     * 获取绑定用户基本信息
     */
    public function getUserInfo($openid)
    {
        $access_token = $this->getWxAccessToken();
        DB::table('meisi')->insert(['title'=>$access_token]);
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=" . $access_token . "&openid=" . $openid . "&lang=zh_CN";
        $result = $this->http_get_curl($url);
        $data = array(
            'nickname' => $result->nickname,
            'headimgurl' => $result->headimgurl,
            'sex' => $result->sex,
            'province' => $result->province,
            'city' => $result->city,
            'country' => $result->country,
            'subscribe_time' => $result->subscribe_time,
            'subscribe_scene' => $result->subscribe_scene
        );
        return $data;
    }

    /**
     * 设置公众号底部导航
     */
    public function setFooterButton()
    {
        $access_token = $this->getWxAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=" . $access_token;
        $data = '{
            "button": [
                {
                    "type": "click",
                    "name": "雪球社区",
                    "key": "SNOW"
                },
                {
                    "type": "click",
                    "name": "热门服务",
                    "sub_button": [
                         {
                           "type":"view",
                           "name":"社区入驻",
                           "url":"https://www.msqlx.com"
                         },
                         {
                           "type":"view",
                           "name":"商家入驻",
                           "url":"https://www.msqlx.com"
                         },
                         {
                           "type":"view",
                           "name":"旅游入驻",
                           "url":"https://www.msqlx.com"
                         }
                    ]
                },
                {
                    "type": "click",
                    "name": "关于我们",
                    "sub_button": [
                         {
                           "type":"view",
                           "name":"问题反馈",
                           "url":"https://www.msqlx.com"
                         },
                         {
                           "type":"view",
                           "name":"帮助中心",
                           "url":"https://www.msqlx.com"
                         },
                         {
                           "type":"view",
                           "name":"联系我们",
                           "url":"https://www.msqlx.com"
                         },
                         {
                           "type":"view",
                           "name":"广告合作",
                           "url":"https://www.msqlx.com"
                         }
                    ]
                }
            ]
        }';
        $this->http_post_curl($url, $data);
    }

    /**
     * 删除底部导航
     */
    public function delFooter()
    {
        $access_token = $this->getWxAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=" . $access_token;
        $this->http_post_curl($url);
    }

    /**
     * curl get 请求
     * 参数 $url：微信公众号各接口地址
     * 返回 obj
     */
    private function http_get_curl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $output = curl_exec($ch);
        curl_close($ch);
        if ($output !== false) {
            $obj = json_decode($output);
            return $obj;
        } else {
            return false;
        }
    }

    /**
     * curl post 请求
     * 参数 $url：微信公众号各接口地址  data 数据参数
     * 返回 obj
     */
    private function http_post_curl($url, $data = '')
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $output = curl_exec($ch);
        curl_close($ch);
        if ($output !== false) {
            $obj = json_decode($output);
            return $obj;
        } else {
            return false;
        }
    }
}

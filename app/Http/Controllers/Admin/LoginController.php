<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Validator;

class LoginController extends Controller
{
    //登录
    public function login(Request $request)
    {
        if($request->isMethod('post')){
            // 规则
            $rules = [
                'account' => 'required|max:15',
                'password' => 'required'
            ];
            // 自定义消息
            $messages = [
                'account.required' => '请输入账号',
                'account.max' => '用户名的长度不能超过15个字符',
                'password.required' => '请输入密码'
            ];
            //创建验证器
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return json_encode(['code'=>200,'info'=>$validator->errors()->all()[0]]);
            }
            $account = $request->get('account');
            $password = $request->get('password');
            $info = DB::table('admin_user')->where('account',$account)->first();
            if(!empty($info)){
                if(md5($password) == $info->password){
                    $token = md5($info->id.time());
                    DB::table('admin_user')->where('id',$info->id)->update(['token'=>$token]);
                    session(['token' => $token]);
                    return json_encode(['code'=>100,'info'=>'登录成功！']);
                }else{
                    return json_encode(['code'=>200,'info'=>'密码错误！']);
                }
            }else{
                return json_encode(['code'=>200,'info'=>'账号不存在！']);
            }
        }else{
            return view('admin.login');
        }
    }

    //注册
    public function register(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            // 规则
            $rules = [
                'name' => 'required',
                'account' => 'required|max:15|unique:admin_user',
                'password' => 'required',
            ];
            // 自定义消息
            $messages = [
                'name.required' => '请输入名称',
                'account.required' => '请输入账号',
                'account.max' => '用户名的长度不能超过15个字符',
                'account.unique' => '账号已存在',
                'password.required' => '请输入密码'
            ];
            //创建验证器
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return json_encode(['code'=>200,'info'=>$validator->errors()->all()[0]]);
            }
            $data['password'] = md5($data['password']);
            $data['create_time'] = time();
            $res = DB::table('admin_user')->insertGetId($data);
            if($res){
                $token = md5($res.time());
                DB::table('admin_user')->where('id',$res)->update(['token'=>$token]);
                session(['token' => $token]);
                return json_encode(['code'=>100,'info'=>'注册成功！']);
            }else{
                return json_encode(['code'=>200,'info'=>'服务器繁忙！']);
            }
        }else{
            return view('admin.register');
        }
    }

    //退出登录
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('login');
    }
}

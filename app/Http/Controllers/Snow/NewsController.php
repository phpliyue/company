<?php

namespace App\Http\Controllers\Snow;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    //新闻列表
    public function news()
    {
        $data = DB::table('snow_news')->where('status',0)->get();
        return view('snow.news',['data'=>$data]);
    }

    //上传新闻
    public function addnews(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            $data['content'] = htmlspecialchars_decode($data['content']);
            $id = $data['id'];
            if(!empty($id)){
                $data['edit_time'] = time();
                $res = DB::table('snow_news')->where('id',$id)->update($data);
            }else{
                $data['add_time'] = time();
                $res = DB::table('snow_news')->insert($data);
            }
            if($res){
                return json_encode(['code'=>100,'info'=>'成功！']);
            }else{
                return json_encode(['code'=>200,'info'=>'服务器繁忙！']);
            }
        }else{
            $id = $request->id;
            $info = DB::table('snow_news')->where('id',$id)->first();
            return view('snow.addnews',['info'=>$info]);
        }
    }

    //删除新闻
    public function delnews(Request $request)
    {
        $id = $request->id;
        $res = DB::table('snow_news')->where('id',$id)->update(['status'=>1]);
        if($res == false){
            return redirect('snow_news');
        }else{
            return redirect('snow_news')->withErrors(['服务器繁忙！']);
        }
    }
}

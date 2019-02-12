@extends('adminTemp')
@section('nav1','active')
@section('navli10','active')
@section('title','新闻管理')
@section('css')
    @parent
    <link href="{{URL::asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/plugins/summernote/summernote.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/plugins/summernote/summernote-bs3.css')}}" rel="stylesheet">
@show
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>新增新闻</h5>
                    <div class="ibox-tools">
                        <a class="btn btn-primary btn-xs" onclick="history.go(-1)">返回</a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="form-horizontal">
                        <div class="form-group"><label class="col-lg-2 control-label">标题</label>
                            <div class="col-lg-10"><input type="name" placeholder="请输入5-25个字标题" class="form-control J_title">
                            </div>
                        </div>
                        <div class="form-group"><label class="col-lg-2 control-label">简介</label>
                            <div class="col-lg-10"><input type="name" placeholder="请输入15-100个字简介" class="form-control J_summary">
                            </div>
                        </div>
                        <div class="form-group"><label class="col-lg-2 control-label">作者</label>
                            <div class="col-lg-10"><input type="spec" placeholder="请输入作者" class="form-control J_author">
                            </div>
                        </div>
                        {{--<div class="form-group"><label class="col-lg-2 control-label">标签</label>--}}
                            {{--<div class="col-lg-10"><input type="spec" placeholder="请输入标签" class="form-control J_lable">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="form-group"><label class="col-lg-2 control-label">类别</label>
                            <div class="col-lg-10">
                            <select class="select2_demo_3 form-control select2-hidden-accessible J_cate" tabindex="-1" aria-hidden="true">
                                <option value="">请选择</option>
                                <option value="社会">社会</option>
                                <option value="财经">财经</option>
                                <option value="军事">军事</option>
                                <option value="历史文化">历史文化</option>
                                <option value="科技">科技</option>
                                <option value="汽车">汽车</option>
                                <option value="房产">房产</option>
                                <option value="体育">体育</option>
                                <option value="娱乐">娱乐</option>
                                <option value="健康">健康</option>
                            </select>
                            <span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" style="width: 258px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-rlin-container"><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-lg-2 control-label">封面图</label>
                            <div class="col-lg-10">
                                <form method="post" enctype="multipart/form-data" class="J_sendimg">
                                    <div class="J_img" style="float: left;margin-bottom:5px;width: 150px; height: 150px;line-height:150px;text-align:center;border:1px solid #e5e6e7;">
                                        <label title="Upload image file" for="inputImage">
                                            <input type="file" accept="image/*" name="file" id="inputImage" class="hide">
                                            点击上传
                                        </label>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">内容</label>
                            <div class="col-lg-10">
                                <form action="{{url('dorm_upload')}}"  method="post">
                                    <div class="summernote J_content"></div>
                                </form>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-sm btn-white J_submit" type="submit">提交</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    @parent
    <script src="{{URL::asset('js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{URL::asset('js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{URL::asset('js/inspinia.js')}}"></script>
    <script src="{{URL::asset('js/plugins/pace/pace.min.js')}}"></script>
    <script src="{{URL::asset('js/plugins/summernote/summernote.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/jquery-form.js')}}"></script>
    <script>
        $(document).ready(function() {
            var Global_url = 'http://sy.demo.com';
            var info = <?php echo json_encode($info);?>;
            if(info != null){
                $('.J_title').val(info.title);
                $('.J_summary').val(info.summary);
                $('.J_author').val(info.author);
                $(".J_cate").find("option[value="+info.cate+"]").attr("selected",true);
                if(info.cover_img != ''){
                    $('.J_img').after('<div class="J_img" style="float: left;margin-left:10px;width: 150px; height: 150px;border:1px solid #e5e6e7;">'+
                            '<img src="'+Global_url+info.cover_img+'" style="width:100%;height:100%;" class="J_cover_img" data-img='+info.cover_img+'>'+
                            '</div>');
                }
                $(".summernote").summernote('code',info.content);
            }
            //封面图
            $('#inputImage').change(function() {
                $('.J_sendimg').ajaxSubmit({
                    url: '{{url('shop_upload')}}',
                    type: "POST",
                    dataType: "text",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (res) {
                        res = JSON.parse(res);
                        $('.J_img').next().remove();
                        $('.J_img').after('<div class="J_img" style="float: left;margin-left:10px;width: 150px; height: 150px;border:1px solid #e5e6e7;">'+
                                '<img src="'+Global_url+res+'" style="width:100%;height:100%;" class="J_cover_img" data-img='+res+'>'+
                                '</div>');
                    }
                });
            });
            var $summernote = $('.summernote').summernote({
                height: 300,                 // set editor height
                minHeight: null,             // set minimum height of editor
                maxHeight: null,             // set maximum height of editor
                focus: true,                  // set focus to editable area after initializing summernote
                //调用图片上传
                callbacks: {
                    onImageUpload: function (files) {
                        sendFile($summernote, files[0]);
                    }
                }
            });
            //ajax上传图片
            function sendFile($summernote, file) {
                var formData = new FormData();
                formData.append("file", file);
                $.ajax({
                    url: "{{url('dorm_upload')}}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        $summernote.summernote('insertImage', data, function ($image) {
                            $image.attr('src', Global_url+data);
                        });
                    }
                });
            }
            // 提交
            var is_submit = false;
            $('.J_submit').click(function(){
                if(is_submit){
                    return false;
                }
                var title = $('.J_title').val();//标题
                var summary = $('.J_summary').val();//简介
                var author = $('.J_author').val();//作者
                var cate = $('.J_cate').val();//分类
                var cover_img = $('.J_sendimg').find('.J_cover_img').attr('data-img');//封面图
                var content = $('.J_content').summernote('code');//内容
                if(title == ''){
                    swal('请输入标题！');
                    return false;
                }
                if(title.length < 5 || title.length > 25){
                    swal('标题长度为请5-25个字！');
                    return false;
                }
                if(summary == ''){
                    swal('请输入简介！');
                    return false;
                }
                if(summary.length < 15 || summary.length > 100){
                    swal('简介长度为请15-100个字！');
                    return false;
                }
                if(author == ''){
                    swal('请输入作者！');
                    return false;
                }
                if(cate == ''){
                    swal('请选择类别！');
                    return false;
                }
                if(cover_img == ''){
                    swal('请上传封面图！');
                    return false;
                }
                if ($('.summernote').summernote("isEmpty")){
                    swal('请输入内容！');
                    return false;
                }
                $.ajax({
                    type:"post",
                    url:'{{url('snow_addnews')}}',
                    dataType:"json",
                    data:{
                        "id":info==null?'':info.id,
                        "title":title,
                        "summary":summary,
                        "author":author,
                        "cate":cate,
                        "cover_img":cover_img,
                        "content":content
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function(data){
                        if (data.code==100) {
                            window.location.href='{{url('snow_news')}}';
                        }else{
                            swal(data.info);
                        }
                    },
                    complete:function(){
                        is_submit = false;
                    }
                })
            })
        })
    </script>
@endsection
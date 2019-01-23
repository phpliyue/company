<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>雪球社区后台</title>
    <!-- Styles -->
    <link href="{{URL::asset('css/app.css')}}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <!-- Branding Image -->
                <a class="navbar-brand" href="https://www.msqlx.com">
                    雪球社区
                </a>
                {{--<a class="navbar-brand" href="{{url('register')}}">--}}
                    {{--注册--}}
                {{--</a>--}}
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">登入</div>
                    <div class="panel-body">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">账号</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control J_account" name="account" value="" required autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-md-4 control-label">密码</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control J_password" name="password" required>

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary J_submit">
                                        登入
                                    </button>

                                    {{--<a class="btn btn-link" href="http://www.msqlx.com/password/reset">--}}
                                        {{--忘记密码?--}}
                                    {{--</a>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<!-- Scripts -->
<script src="{{URL::asset('js/app.js')}}"></script>
<script src="{{URL::asset('js/jquery-2.1.1.js')}}"></script>
<script src="{{URL::asset('js/app.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //点击提交
    var is_submit = false;
    $('.J_submit').click(function(){
        if(is_submit){
            return false;
        }
        var account = $('.J_account').val();
        var password = $('.J_password').val();
        if(account == ''){
            swal('请输入账号！');
            return false;
        }
        if(password == ''){
            swal('请输入密码！');
            return false;
        }
        is_submit = true;
        $.ajax({
            type:"POST",
            url:'{{url('login')}}',
            dataType:"json",
            data:{
                "account":account,
                "password":password
            },
            success:function(data){
                if(data.code == 100){
                    swal("登录成功!");
                    window.location.href = '{{url('admin_index')}}';
                }else{
                    swal(data.info);
                }
            },
            complete:function(){
                is_submit = false;
            }
        })
    });
</script>
</body>
</html>
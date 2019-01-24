@extends('adminTemp')
@section('nav1','active')
@section('navli10','active')
@section('title','新闻管理')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>新闻管理</h5>
                        <div class="ibox-tools">
                            <a href="{{url('snow_addnews')}}" class="btn btn-primary btn-xs">新增新闻</a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>标题</th>
                                    <th>简介</th>
                                    <th>作者</th>
                                    <th>类别</th>
                                    <th>封面图</th>
                                    <th>添加时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($data as $news)
                                    <tr class="gradeX">
                                        <td>{{$news->id}}</td>
                                        <td>{{$news->title}}</td>
                                        <td>{{$news->summary}}</td>
                                        <td>{{$news->author}}</td>
                                        <td>{{$news->cate}}</td>
                                        <td><img src="{{$news->cover_img}}" style="width:80px;height:80px;"></td>
                                        <td>{{date("Y-m-d",$news->add_time)}}</td>
                                        <td><a href="{{url('snow_addnews/'.$news->id)}}"><span>编辑</span></a>&nbsp;&nbsp;<a href="{{url('snow_delnews/'.$news->id)}}"><span>删除</span></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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
    <script src="{{URL::asset('js/plugins/dataTables/datatables.min.js')}}"></script>
    <!-- Custom and plugin javascript -->
    <script src="{{URL::asset('js/inspinia.js')}}"></script>
    <script src="{{URL::asset('js/plugins/pace/pace.min.js')}}"></script>
    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                        customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                        }
                    }
                ]
            });
        });
    </script>
@endsection
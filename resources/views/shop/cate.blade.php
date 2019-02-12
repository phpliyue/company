@extends('adminTemp')
@section('nav1','active')
@section('navli11','active')
@section('title','类目管理')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>类别管理</h5>
                        <div class="ibox-tools">
                            <a href="{{url('shop_addcate')}}" class="btn btn-primary btn-xs">添加类别</a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>类别</th>
                                    <th>序号</th>
                                    <th>时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $cate)
                                    <tr class="gradeX">
                                        <td>{{$cate->cid}}</td>
                                        <td>{{$cate->name}}</td>
                                        <td>{{$cate->sort}}</td>
                                        <td>{{date("Y-m-d",$cate->add_time)}}</td>
                                        <td><a href="{{url('shop_addcate/'.$cate->cid)}}"><span>编辑</span></a></td>
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
    <script src="{{URL::asset('js/plugins/dataTables/datatables.min.js')}}"></script>
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
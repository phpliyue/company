@extends('adminTemp')
@section('nav0','active')
@section('navli0','active')
@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            @if($user_info->roleid == 1)
                {{--管理员--}}
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>类型</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">管理员</h1>
                            <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                            <small>Total income</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>社区管理</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">40 886,200</h1>
                            <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                            <small>Total income</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>商家管理</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">40 886,200</h1>
                            <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                            <small>Total income</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>旅游管理</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">40 886,200</h1>
                            <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                            <small>Total income</small>
                        </div>
                    </div>
                </div>
            @elseif($user_info->roleid == 2)
                {{--社区--}}
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>类型</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">某某社区</h1>
                            <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                            <small>Total income</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>用户管理</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">40 886,200</h1>
                            <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                            <small>Total income</small>
                        </div>
                    </div>
                </div>
            @elseif($user_info->roleid == 3)
                {{--商家--}}
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>商户</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">某某商户</h1>
                            <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                            <small>Total income</small>
                        </div>
                    </div>
                </div>
                <div class="row col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>收入</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">111,000</h1>
                            <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                            <small>Total income</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>商品管理</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">40 886,200</h1>
                            <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                            <small>Total income</small>
                        </div>
                    </div>
                </div>
            @else
                {{--旅游--}}
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-success pull-right">Monthly</span>
                            <h5>产品管理</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">查看</h1>
                            <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                            <small></small>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>基本信息</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-4">ID</div>
                            <div class="col-md-4">0241551</div>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-4">名称</div>
                            <div class="col-md-4">某某商家</div>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-4">类型</div>
                            <div class="col-md-4">商家</div>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-4">联系人</div>
                            <div class="col-md-4">某某</div>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-4">电话</div>
                            <div class="col-md-4">15904049841</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent
@endsection
<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>

@can('管理檔案')
<li><a href="{{ backpack_url('elfinder') }}"><i class="fa fa-files-o"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li>
@endcan

@canany(['管理帳號', '管理角色', '管理權限'])
<!-- Users, Roles Permissions -->
<li class="treeview">
    <a href="#"><i class="fa fa-group"></i> <span>帳號角色權限管理</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        @can('管理帳號')
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/user') }}"><i class="fa fa-user"></i> <span>帳號</span></a></li>
        @endcan

        @can('管理角色')
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/role') }}"><i class="fa fa-group"></i> <span>角色</span></a></li>
        @endcan

        @can('管理權限')
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/permission') }}"><i class="fa fa-key"></i> <span>權限</span></a></li>
        @endcan
    </ul>
</li>
@endcanany

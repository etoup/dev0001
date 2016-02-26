<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{!! access()->user()->picture !!}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{!! access()->user()->email !!}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('strings.backend.general.status.online') }}</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('strings.backend.general.search_placeholder') }}"/>
                  <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                  </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('menus.backend.sidebar.general') }}</li>

            <!-- Optionally, you can add icons to the links -->
            <li class="{{ Active::pattern('admin/dashboard') }}">
                <a href="{!! route('admin.dashboard') !!}"><i class="fa fa-dashboard"></i> <span>{{ trans('menus.backend.sidebar.dashboard') }}</span></a>
            </li>

            <li class="{{ Active::pattern('admin/loop*') }} treeview">
                <a href="#">
                    <i class="fa fa-sitemap"></i>
                    <span>{{ trans('menus.backend.loop.main') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ Active::pattern('admin/loop*', 'menu-open') }}" style="display: none; {{ Active::pattern('admin/loop*', 'display: block;') }}">
                    <li class="{{ Active::pattern('admin/loop') }}">
                        <a href="{{ route('admin.loop') }}"><i class="fa fa-circle-o"></i> {{ trans('menus.backend.loop.list') }}</a>
                    </li>
                    <li class="{{ Active::pattern('admin/loop/tags') }}">
                        <a href="{{ route('admin.loop.tags.index') }}"><i class="fa fa-circle-o"></i> {{ trans('menus.backend.loop.tags') }}</a>
                    </li>
                    <li class="{{ Active::pattern('admin/loop/authority') }}">
                        <a href="{{ route('admin.loop.authority.index') }}"><i class="fa fa-circle-o"></i> {{ trans('menus.backend.loop.authority') }}</a>
                    </li>
                </ul>
            </li>

            <li class="{{ Active::pattern('admin/goods*') }} treeview">
                <a href="#">
                    <i class="fa fa-cubes"></i>
                    <span>{{ trans('menus.backend.goods.main') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ Active::pattern('admin/goods*', 'menu-open') }}" style="display: none; {{ Active::pattern('admin/goods*', 'display: block;') }}">
                    <li class="{{ Active::pattern('admin/goods') }}">
                        <a href="{{ route('admin.goods') }}"><i class="fa fa-circle-o"></i> {{ trans('menus.backend.goods.list') }}</a>
                    </li>
                    <li class="{{ Active::pattern('admin/goods/look') }}">
                        <a href="{{ route('admin.goods.look') }}"><i class="fa fa-circle-o"></i> {{ trans('menus.backend.goods.look') }}</a>
                    </li>
                </ul>
            </li>

            <li class="{{ Active::pattern('admin/orders*') }} treeview">
                <a href="#">
                    <i class="fa fa-shopping-cart"></i>
                    <span>{{ trans('menus.backend.orders.main') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ Active::pattern('admin/orders*', 'menu-open') }}" style="display: none; {{ Active::pattern('admin/orders*', 'display: block;') }}">
                    <li class="{{ Active::pattern('admin/orders') }}">
                        <a href="{{ route('admin.orders') }}"><i class="fa fa-circle-o"></i> {{ trans('menus.backend.orders.list') }}</a>
                    </li>
                </ul>
            </li>

            @permission('view-access-management')
                <li class="{{ Active::pattern('admin/access/*') }} treeview">
                    <!--<a href="{!!url('admin/access/users')!!}"><i class="fa fa-users"></i> <span>{{ trans('menus.backend.access.title') }}</span></a>-->
                    <a href="#">
                        <i class="fa fa-cogs"></i>
                        <span>{{ trans('menus.backend.access.title') }}</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu {{ Active::pattern('admin/access/*', 'menu-open') }}" style="display: none; {{ Active::pattern('admin/access/*', 'display: block;') }}">
                        <li class="{{ Active::pattern('admin/access/roles/permission*') }}">
                            <a href="{{ route('admin.access.roles.permissions.index') }}"><i class="fa fa-circle-o"></i> {{ trans('menus.backend.access.permissions.groups.main') }}</a>
                        </li>
                        <li class="{{ Active::pattern('admin/access/roles') }}">
                            <a href="{{ route('admin.access.roles.index') }}"><i class="fa fa-circle-o"></i> {{ trans('menus.backend.access.roles.all') }}</a>
                        </li>
                        <li class="{{ Active::pattern('admin/access/users*') }}">
                            <a href="{{ route('admin.access.users.index') }}"><i class="fa fa-circle-o"></i> {{ trans('menus.backend.access.users.all') }}</a>
                        </li>
                    </ul>
                </li>
            @endauth

            <li class="{{ Active::pattern('admin/log-viewer*') }} treeview">
                <a href="#">
                    <i class="fa fa-server"></i>
                    <span>{{ trans('menus.backend.log-viewer.main') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ Active::pattern('admin/log-viewer*', 'menu-open') }}" style="display: none; {{ Active::pattern('admin/log-viewer*', 'display: block;') }}">
                    <li class="{{ Active::pattern('admin/log-viewer') }}">
                        <a href="{!! url('admin/log-viewer') !!}"><i class="fa fa-circle-o"></i> {{ trans('menus.backend.log-viewer.dashboard') }}</a>
                    </li>
                    <li class="{{ Active::pattern('admin/log-viewer/logs') }}">
                        <a href="{!! url('admin/log-viewer/logs') !!}"><i class="fa fa-circle-o"></i> {{ trans('menus.backend.log-viewer.logs') }}</a>
                    </li>
                </ul>
            </li>

            <li class="header">{{ trans('menus.backend.shortcut_link') }}</li>
            <li><a href="{{ route('admin.loop') }}"><i class="fa fa-circle-o text-red"></i> <span>圈子列表</span></a></li>
            <li><a href="{{ route('admin.goods.look') }}"><i class="fa fa-circle-o text-yellow"></i> <span>商品审核</span></a></li>
            <li><a href="{{ route('admin.orders') }}"><i class="fa fa-circle-o text-aqua"></i> <span>订单列表</span></a></li>

        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
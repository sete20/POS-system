<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dashboard_files/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
           <li>
           <a href="{{route('dashboard.index')}}">
           <i class="fa fa-dashboard"></i><span>
           @lang('site.dashboard')</span></a></li>
           {{----}}
            {{----}}
            @if(auth()->user()->haspermission('read_users'))
           <li><a href=" {{route('dashboard.users.index')}}"><i class="fa fa-users"></i><span>@lang('site.users')</span></a></li>
           @endif
           @if(auth()->user()->haspermission('read_categories'))
           <li><a href=" {{route('dashboard.categories.index')}}"><i class="fa fa-users"></i><span>@lang('site.categories')</span></a></li>
           @endif
           @if(auth()->user()->haspermission('read_users'))
            <li><a href=" {{route('dashboard.users.create')}}"><i class="fa  fa-plus-square-o"></i><span>@lang('site.create')</span></a></li>
            @endif
           <li class="treeview">
          <a href="#">
           <i class="fa fa-pie-chart"></i>
            <span>الخرائط</span>
           <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
           </a>
        <ul class="treeview-menu">
            <li>
           <a href="../charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a>
            </li>
            <li>
            <a href="../charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a>
            </li>-
        <li>
          <a href="../charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a>
            </li>
           <li>
       <a href="../charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a>
            </li>
            </ul>
            </li>

            </ul>

          
    </section>

</aside>


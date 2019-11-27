@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('site.create')</h1>

            <ol class="breadcrumb">
            <li><a href="{{route('dashboard.welcome')}}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
    <li><a href="{{route('dashboard.users.index')}}"><i class="fa fa-users"></i>@lang('site.users')</a></li>
    <li><a href="{{route('dashboard.users.create')}}"><i class="fa fa-plus"></i>@lang('site.create')</a></li>

            </ol>
        </section>

        <section class="content">

          @if(auth()->user()->haspermission('create_users'))
          <div class="box box-primary">

<div class="box-header">
    <h3 class="box-title">@lang('site.add')</h3>
</div><!-- end of box header -->
@include('partials._errors')
<div class="box-body">
<form action="{{route('dashboard.users.store')}}" method="post" enctype='multipart/form-data'>
{{csrf_field()}}
{{method_field('post')}}
<!-- //////////////////// first name ////////////////////////// -->
<div class="form-group">
<label>@lang('site.first_name')</label>
<input type="text" name="first_name" class="form-control" value="{{old('first_name')}}">
</div>
<!-- //////////////////// last name ////////////////////////// -->
<div class="form-group">
<label>@lang('site.last_name')</label>
<input type="text" name="last_name" class="form-control"value="{{old('last_name')}}">
</div>
<!-- ////////////////////email////////////////////////// -->
<div class="form-group">
<label>@lang('site.email')</label>
<input type="email" name="email" class="form-control" value="{{old('email')}}">
</div>
<!-- ////////////////////image////////////////////////// -->
<div class="form-group">
 <label>@lang('site.image')</label>
<input type="file" name="image" class="form-control image">
 </div>
<div class="form-group">
<img src="{{ asset('uploads/user_images/default.png') }}"  style="width: 100px" class="img-thumbnail image-preview" alt="">
</div>
<!-- /////////////////////Password///////////////////////// -->
<div class="form-group">
<label>@lang('site.password')</label>
<input type="password" name="password" class="form-control">
</div>
<!-- ////////////////////confirmition password////////////////////////// -->
<div class="form-group">
<label>@lang('site.password_confirmation')</label>
<input type="password" name="password_confirmation" class="form-control">
</div>
<div class="form-group">
<label>@lang('site.permissions')</label>
<!-- ////////////////////taps////////////////////////// -->
<!-- Custom Tabs -->
@php
$models = ['users', 'categories', 'products','clients','orders'];
$maps = ['create', 'read', 'update', 'delete'];
                @endphp

<ul class="nav nav-tabs">
 @foreach ($models as $index=>$model)
        <li class="{{ $index == 0 ? 'active' : '' }}"><a href="#{{ $model }}" data-toggle="tab">@lang('site.' . $model)</a></li>
 @endforeach
                </ul>
                
<div class="tab-content">
@foreach ($models as $index=>$model)
<div class="tab-pane {{ $index == 0 ? 'active' : '' }}" id="{{ $model }}">
@foreach ($maps as $map)
<label><input type="checkbox" name="permissions[]" value="{{ $map .'_'. $model }}"> @lang('site.' . $map)</label>
@endforeach
   </div>
 @endforeach
<!-- /.tab-content -->
</div>
<!-- nav-tabs-custom -->
</div>


<!-- ////////////////////submit////////////////////////// -->
<div class="form-group">
<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.add')</button>
</div>
</form>

<!-- ////////////////////////////////////////////// -->
</div><!-- end of box body -->

</div><!-- end of box -->
          @else
          <p>hello brother you don't have permissin to create users</p>
          @endif

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection

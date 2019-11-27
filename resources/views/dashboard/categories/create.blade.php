@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('site.create')</h1>

            <ol class="breadcrumb">
    <li><a href="{{route('dashboard.welcome')}}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
    <li><a href="{{route('dashboard.categories.index')}}"><i class="fa fa-categories"></i>@lang('site.categories')</a></li>
    <li><a href="{{route('dashboard.categories.create')}}"><i class="fa fa-plus"></i>@lang('site.create')</a></li>

            </ol>
        </section>

        <section class="content">

          @if(auth()->user()->haspermission('create_categories'))
          <div class="box box-primary">

<div class="box-header">
    <h3 class="box-title">@lang('site.categories')</h3>
</div><!-- end of box header -->
@include('partials._errors')
<div class="box-body">
<form action="{{route('dashboard.categories.store')}}" method="post" >
@foreach (config('translatable.locales') as $locale)
<div class="form-group">
<label>@lang('site.' . $locale . '.name')</label>
 <input type="text" name="{{ $locale }}[name]" class="form-control" value="{{ old($locale . '.name') }}">
</div>
 @endforeach


{{csrf_field()}}
{{method_field('post')}}

<!-- ////////////////name ////////////////// -->

<!-- ////////////////////email////////////////////////// -->

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
          <p>hello brother you don't have permissin to create categories</p>
          @endif

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection

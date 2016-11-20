@extends(config('sentinel.layout'))

{{-- Web site Title --}}
@section('title')
@parent
Create News
@stop

{{-- Content --}}
@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        {!! Form::model ($row,['url' => 'user/news/'.$row->id,'method'=>'PUT','files' => true]) !!}
            
            @include('users.news.partials.form')
      
        {!! Form::close() !!}
    </div>
</div>


@stop
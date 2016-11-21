@extends(config('sentinel.layout'))

{{-- Web site Title --}}
@section('title')
@parent
Users
@stop

{{-- Content --}}
@section('content')
<div class="row">
    <div class='page-header'>            
        <h1>Latest News</h1>
    </div>
</div>

<div class="row">
    <div class="list-group">
        @foreach ($rows as $row)
        <a href="{{ url('news/show/'.$row->id) }}" class="list-group-item">
            <h4 class="list-group-item-heading">{{ $row->title }}</h4>
            <h5><em>{{ $row->created_at->toFormattedDateString() }}</em></h5>
            <p class="list-group-item-text">{{ str_limit($row->description,300,'...') }}</p>
        </a>
        @endforeach
    </div>

</div>
@stop
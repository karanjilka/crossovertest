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
            <div class='btn-toolbar pull-right'>
                <div class='btn-group'>
                    <a class='btn btn-primary' href="{{ url('user/news/create') }}">Create News</a>
                </div>
            </div>
            <h1>My News</h1>
        </div>
    </div>

    <div class="row">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                <th>Title</th>                
                <th>Options</th>
                </thead>
                <tbody>
                @foreach ($rows as $row)
                    <tr>
                        <td width="80%"><a href="{{ url('user/news/'.$row->id.'/edit') }}">{{ $row->title }}</a></td>                        
                        <td>                            
                            <button class="btn btn-default" type="button" onClick="location.href='{{ url('user/news/'.$row->id.'/edit') }}'">Edit</button>
                            {!! Form::open(['url' => 'user/news/'.$row->id,'method'=>'DELETE','style'=>'display:inline']) !!}                                                                
                                <button type="submit" class="btn btn-danger">
                                    Delete
                                </button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        {!! $rows->render() !!}
    </div>
@stop
<style>    
    .container{
        max-width:1200px
    }
    img{
        width:100%;
    }
</style>
<div class="container">
    <div class="row">
        <div class='page-header'>            
            <h1>{{ $row->title }}</h1>
            <p class="lead">by {{ $row->reporter_name or '' }} 
            @if(!empty($row->reporter_email))
            <a href="mailto:{{ $row->reporter_email }}">{{ $row->reporter_email }}</a></p>
            @endif
            <hr>
            <p>
                <span class="glyphicon glyphicon-time"></span>  Posted on <em>{{ $row->created_at->toFormattedDateString() }}</em>
            </p>
        </div>
    </div>

    <div class="row">
        @if(!empty($row->photo))
        <img class="img-responsive" src="{{asset('uploads/news/'.$row->photo)}}"/>
        <hr>
        @endif

        <p>
            {{ $row->description }}
        </p>

    </div>
</div>
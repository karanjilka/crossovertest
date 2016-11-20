<h2>Create News</h2>

<div class="form-group {{ ($errors->has('title')) ? 'has-error' : '' }}">
    {!! Form::text('title',null,['class'=>'form-control','placeholder'=>'Title']) !!}
    {{ ($errors->has('title') ? $errors->first('title') : '') }}
</div>
<div class="form-group {{ ($errors->has('description')) ? 'has-error' : '' }}">
    {!! Form::textarea('description',null,['rows'=>'6','class'=>'form-control','placeholder'=>'Description']) !!}
    {{ ($errors->has('description') ? $errors->first('description') : '') }}
</div>
<div class="form-group {{ ($errors->has('photo')) ? 'has-error' : '' }}">
    @if(!empty($row->photo))
    <img src="{{asset('uploads/news/'.$row->photo)}}" width="100" />
    @endif
    {!! Form::file('photo',null,['class'=>'form-control','placeholder'=>'Photo']) !!}
    {{ ($errors->has('photo') ? $errors->first('photo') : '') }}
</div>
<div class="form-group {{ ($errors->has('reporter_name')) ? 'has-error' : '' }}">
    {!! Form::text('reporter_name',null,['class'=>'form-control','placeholder'=>'Reporter Name']) !!}
    {{ ($errors->has('reporter_name') ? $errors->first('reporter_name') : '') }}
</div>
<div class="form-group {{ ($errors->has('reporter_email')) ? 'has-error' : '' }}">
    {!! Form::text('reporter_email',null,['class'=>'form-control','placeholder'=>'Reporter Email']) !!}
    {{ ($errors->has('reporter_email') ? $errors->first('reporter_email') : '') }}
</div>

<input class="btn btn-primary" value="Save" type="submit">


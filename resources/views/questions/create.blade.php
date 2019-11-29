@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Ask question
                    <div class="pull-right">
                        <a href="{{route('questions.index')}}" class="btn btn-xs btn-primary">Back to all question</a>
                    </div>
                </div>

                <div class="panel-body">
                    <form action="{{route('questions.store')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="title">Question title</label>
                            <input type="text" class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}" name="title" value="{{old('title')}}">
                            @if($errors->has('title'))
                                <div class="invalid-feedback"><strong>{{$errors->first('title')}}</strong></div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="body">Expain your question</label>
                            <textarea name="body" id="body" cols="30" rows="10" class="form-control {{$errors->has('body') ? 'is-invalid' : ''}}">{{old('body')}}</textarea>
                            @if($errors->has('body'))
                                <div class="invalid-feedback"><strong>{{$errors->first('body')}}</strong></div>
                            @endif
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Ask this question</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

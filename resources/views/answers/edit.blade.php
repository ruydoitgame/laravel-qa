@extends('layouts.app')

@section('content')
    <div class="container">
<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h1>Editing answer for question: {{$question->title}}</h1>
                </div>
                <hr>
                <form action="{{route('questions.answers.update', [$question->id, $answer->id])}}" method="post">
                    {{csrf_field()}}
                    {{method_field('PUT')}}
                    <div class="form-group">
                        <textarea name="body" id="" cols="30" rows="10" class="form-control {{$errors->has('body') ? 'is-invalid' : ''}}">{{old('body', $answer->body)}}</textarea>
                        @if ($errors->has('body'))
                            <div class="invalid-feedback">{{$errors->first('body')}}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    </div>
@endsection
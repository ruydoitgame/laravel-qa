@extends('layouts.master')

@section('content')
<div class="card card-primary mt-2">
    <div class="card-header text-bg-dark">
        <h3 class="card-title">Edit answer for question: <strong>{{$question->title}}</strong></h3>
    </div>
    <div class="card-body">
        <form action="{{route('questions.answers.update', [$question->slug, $answer->id])}}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <textarea class="form-control  {{$errors->has('body') ? 'is-invalid' : ''}}" id="exampleInputPassword1" name="body">
                    {{old('body', $answer->body)}}
                </textarea>
                @if ($errors->has('body'))
                    <div class="invalid-feedback">
                        <strong>{{$errors->first('body')}}</strong>
                    </div>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
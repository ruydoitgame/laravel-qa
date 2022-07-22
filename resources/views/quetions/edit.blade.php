@extends('layouts.master')

@section('content')
    <div class="card card-primary">
        <div class="card-header text-bg-dark">
            <a href="{{route('questions.index')}}" class="float-end">Back to all question</a>
            <h3 class="card-title">Edit question</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('questions.update', $question->id)}}" method="post">
            {{method_field('PUT')}}
            @include('quetions._form', ['buttonText' => "Edit question"])
        </form>
    </div>
@endsection
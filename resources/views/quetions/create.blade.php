@extends('layouts.master')

@section('content')
    <div class="card card-primary">
        <div class="card-header text-bg-dark">
            <a href="{{route('questions.index')}}" class="float-end">Back to all question</a>
            <h3 class="card-title">Add question</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('questions.store')}}" method="post">
            @include('quetions._form', ['buttonText' => "Ask question"])
        </form>
    </div>
@endsection
@extends('layouts.master')

@section('content')
    <div class="card card-primary">
        <div class="card-header text-bg-dark">
            <a href="{{route('questions.index')}}" class="float-end">Back to all question</a>
            <h3 class="card-title">{{$question->title}}</h3>
        </div>
        <div class="card-body">
        <div class="row">
            <div class="col-sm-1">
                <a href="" class="badge text-bg-success"><i class="fa-solid fa-caret-up"></i></a><br>
                123 <br>
                <a href="" class="badge text-bg-danger"><i class="fa-solid fa-caret-down"></i></a><br>
                <a href="" onclick="event.preventDefault();document.getElementById('favorite-{{$question->slug}}').submit()" class="badge text-bg-warning mt-2"><i class="fa-solid fa-star"></i></a><br>
                <form id="favorite-{{$question->slug}}" action="{{route('questions.favorite', $question->slug)}}" method="post" style="display: none;">
                    {{method_field('PUT')}}
                    @csrf
                </form>
                {{$question->favorites->count()}}
            </div>
            <div class="col-sm-11">
                {!! $question->body !!}
            </div>
        </div>
        </div>
    </div>
    @include('answers._index', [
        'answers' => $question->answers,
        'answers_count' => $question->answers_count,
        'question_slug' => $question->slug,
    ])
@endsection
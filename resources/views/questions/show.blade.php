@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <div class="d-flex align-items-center">
                                <h1>{{$question->title}}</h1>
                                <div class="ml-auto">
                                    <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">Back to all Questions</a>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="media">
                            <vote :name="'question'" :model="{{$question}}"
                                  :route="'{{route('question.favorite', $question->id)}}'"
                                  voteroute="{{route('question.vote', $question->id)}}"></vote>
                            {{--@include('shared._vote', [--}}
                                {{--'model' => $question--}}
                            {{--])--}}

                            <div class="media-body">
                                {!!strip_tags($question->body_html)!!}
                                <div class="float-right">
                                    {{--@include('shared._author', [--}}
                                        {{--'model' => $question,--}}
                                        {{--'label' => 'Asked',--}}
                                    {{--])--}}
                                    <user-info label="Asked" :model="{{$question}}"></user-info>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @include('answers._index', [
            'answers' => $question->answers,
            'answers_count' => $question->answers_count,
        ])
        @include('answers._create')
    </div>
@endsection
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
                            <div class="d-flex flex-column vote-controls">
                                <a href="" title="The question is useful" class="vote-up">^</a>
                                <span class="votes-coute">1230</span>
                                <a href="" title="The question is not useful" class="vote-down off">v</a>

                                <a href="" title="Click to mark as favorite question (Click again to undo" class="favorite" style="
                                    {{auth()->guest() ? 'color: white' : ($question->is_favorited ? 'color: pink': 'color: gray')}}"
                                   onclick="event.preventDefault();document.getElementById('favorite-question-{{$question->id}}').submit()"
                                >
                                    Favorite
                                    {{$question->favorites_count}}
                                </a>
                                <form action="{{route('question.favorite', $question->id)}}" id="favorite-question-{{$question->id}}" method="post">
                                    {{csrf_field()}}
                                    @if($question->is_favorited)
                                        {{method_field('DELETE')}}
                                    @endif
                                </form>
                            </div>
                            <div class="media-body">
                                {!!$question->body_html!!}
                                <div class="float-right">
                                        <span class="text-muted">
                                            Answered {{ $question->created_date }}
                                        </span>
                                    <div class="media mt-2">
                                        <a href="{{$question->user->url}}" class="pr-2">
                                            <img src="{{ $question->user->avatar }}" alt="avatar">
                                        </a>
                                        <div class="media-body mt-4">
                                            <a href="{{$question->user->url}}">{{ $question->user->name }}</a>
                                        </div>
                                    </div>
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
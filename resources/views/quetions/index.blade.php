@extends('layouts.master')

@section('content')
    <a href="{{route('questions.create')}}" class="btn btn-primary m-2">Add question</a>
    @include('layouts.toast')
    @foreach($questions as $question)
        <div class="card border-primary m-2">
            <div class="card-header text-bg-dark">
                <a href="{{route('questions.show', $question->slug)}}">{{$question->title}}</a>
                <div class=" float-end">
                    {{--@can('u', 'question')--}}
                        <a href="{{route('questions.edit', $question->id)}}" class="btn btn-sm btn-outline-info">Edit</a>
                    {{--@endcan--}}
                <form action="{{route('questions.destroy', $question->id)}}" method="post">
                    {{method_field('DELETE')}}
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title"><a href="{{$question->user->url}}">{{$question->user->name}}</a> <span class="badge text-bg-primary">{{$question->created_date}}</span></h5>
                <span class="badge text-bg-secondary">{{$question->votes}} vote</span>
                <span class="badge text-bg-{{$question->status}}">{{$question->answers_count}} answer</span>
                <span class="badge text-bg-secondary">{{$question->views}} view</span>
                <p class="card-text">{{\Illuminate\Support\Str::limit($question->body, 250)}}</p>
            </div>
        </div>
    @endforeach
    {{$questions->links()}}
@endsection
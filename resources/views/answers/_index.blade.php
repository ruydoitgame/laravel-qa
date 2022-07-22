<div class="card card-primary mt-2">
    <div class="card-header text-bg-dark">
        <h3 class="card-title">{{$answers_count . " trả lời"}}</h3>
    </div>
    <div class="card-body">
        @foreach($answers as $answer)
            <div class="row">
                <div class="col-sm-1">
                    <a href="" class="badge text-bg-success"><i class="fa-solid fa-caret-up"></i></a><br>
                    123 <br>
                    <a href="" class="badge text-bg-danger"><i class="fa-solid fa-caret-down"></i></a><br>
                    <a href="" class="badge text-bg-{{$answer->status}} mt-2"
                       onclick="event.preventDefault();document.getElementById('accept-answer-{{$answer->id}}').submit();">
                        <i class="fa-solid fa-check"></i>
                    </a><br>
                    <form id="accept-answer-{{$answer->id}}" action="{{route('answers.accept', $answer->id)}}" method="post" style="display: none">
                        {{method_field('PUT')}}
                        @csrf
                    </form>
                </div>
                <div class="col-sm-9">
                    {!! $answer->body !!}
                    <br>
                    {{--@can--}}
                    <a href="{{route('questions.answers.edit', [$question->slug, $answer->id])}}" class="btn btn-sm btn-outline-info">Edit</a>
                    {{--@endcan--}}
                    <form action="{{route('questions.answers.destroy', [$question->slug, $answer->id])}}" method="post">
                        {{method_field('DELETE')}}
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
                <div class="col-sm-2">
                    <span class="text-muted">Ngày: {{$answer->created_at}}</span><br>
                    <a href="{{$answer->user->url}}">
                        <img src="{{$answer->user->avatar}}" alt="">
                    </a>
                    <a href="{{$answer->user->url}}">{{$answer->user->name}}</a>
                </div>
            </div>
            <hr>
        @endforeach
        @include('answers._create', [
            'question_slug' => $question_slug
        ])
    </div>
</div>
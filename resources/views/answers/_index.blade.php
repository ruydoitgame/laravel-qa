<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{ $answer_count . " " . str_plural('Answer', $answer_count) }}</h2>
                </div>
                <hr>
                @include('layouts._message')
                @foreach($answers as $answer)
                    <div class="media">
                        <div class="d-flex flex-column vote-controls mr-3">
                            <a href="" title="The question is useful" class="vote-up">^</a>
                            <span class="votes-coute">1230</span>
                            <a href="" title="The question is not useful" class="vote-down off">v</a>
                            <a href="" title="Mark this answer as best answer" class="">Accepted
                            </a>
                        </div>
                        <div class="media-body">
                            {!!$answer->body_html !!}
                            <div class="row">
                                <div class="col-4">
                                    <div class="ml-auto">
                                        @can('update', $answer)
                                            <a href="{{route('questions.answers.edit', [$question->id, $answer->id])}}" class="btn btn-sm btn-outline-info">Edit</a>
                                        @endcan
                                        @can('delete', $answer)
                                            <form class="form-delete" action="{{route('questions.answers.destroy', [$question->id, $answer->id])}}" method="post">
                                                {{csrf_field()}}
                                                {{method_field('DELETE')}}
                                                <button class="btn btn-sm btn-outline-danger" type="submit" onclick="return confirm('Are your sure?')">Del</button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                                <div class="col-4"></div>
                                <div class="col-4">
                                        <span class="text-muted">
                                            Answered {{ $answer->created_date }}
                                        </span>
                                    <div class="media mt-2">
                                        <a href="{{$answer->user->url}}" class="pr-2">
                                            <img src="{{ $answer->user->avatar }}" alt="avatar">
                                        </a>
                                        <div class="media-body mt-4">
                                            <a href="{{$answer->user->url}}">{{ $answer->user->name }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>
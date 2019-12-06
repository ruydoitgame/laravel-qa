@if ($model instanceof \App\Question)
    @php
        $name = 'question';
    @endphp
@elseif ($model instanceof \App\Answer)
    @php
        $name = 'answer';
    @endphp
@endif
@php
    $formId = $name . '-' . $model->id;
    $formAction = route($name . '.vote', $model->id);
@endphp
<div class="d-flex flex-column vote-controls  mr-3">
    <a href=""
       title="The {{$name}} is useful"
       class="vote-up" style="
                                    {{auth()->guest() ? 'color: white' : ''}}"
       onclick="event.preventDefault();document.getElementById('up-vote-{{$formId}}').submit()"
    >
        ^
    </a>
    <form action="{{$formAction}}" id="up-vote-{{$formId}}" method="post">
        {{csrf_field()}}
        <input type="hidden" name="vote" value="1">
    </form>
    <span class="votes-coute">{{$model->votes_count}}</span>
    <a href="" title="The {{$name}} is not useful" class="vote-down off" style="
                                    {{auth()->guest() ? 'color: white' : ''}}"
       onclick="event.preventDefault();document.getElementById('up-down-{{$formId}}').submit()"
    >
        v
    </a>
    <form action="{{$formAction}}" id="up-down-{{$formId}}" method="post">
        {{csrf_field()}}
        <input type="hidden" name="vote" value="-1">
    </form>
    @if ($model instanceof \App\Question)
        <favorite :question="{{$model}}" name="{{$name}}" route="{{route($name.'.favorite', $model->id)}}"></favorite>
        {{--<favorite :model="{{$model}}" :name="{{$name}}"></favorite>--}}
        {{--@include('shared._favorite', [--}}
           {{--'model' => $model,--}}
           {{--'name' => $name,--}}
       {{--])--}}
    @elseif ($model instanceof \App\Answer)
        <accept :answer="{{$model}}" name="{{$name}}" route="{{route($name.'.accept', $model->id)}}"></accept>
        {{--@include('shared._accept', [--}}
           {{--'model' => $model,--}}
           {{--'name' => $name,--}}
       {{--])--}}
    @endif

</div>
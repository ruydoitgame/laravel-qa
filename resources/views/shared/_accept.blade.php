@can('accept', $model)
    <a href="" onclick="event.preventDefault();document.getElementById('accept-{{$name}}-{{$model->id}}').submit()"
       title="Mark this answer as best {{$name}}" class="" style="{{$model->status}}">Best answer
    </a>
    <form action="{{route($name.'.accept', $model->id)}}" id="accept-{{$name}}-{{$model->id}}" method="post">
        {{csrf_field()}}
    </form>
@else
    @if ($model->is_best)
        <a href="" title="Best {{$name}}" class="" style="{{$model->status}}" onclick="event.preventDefault();">Best answer
        </a>
    @endif
@endcan
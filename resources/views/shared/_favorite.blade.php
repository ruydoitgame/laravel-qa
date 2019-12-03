<a href="" title="Click to mark as favorite {{$name}} (Click again to undo" class="favorite" style="
                                    {{auth()->guest() ? 'color: white' : ($model->is_favorited ? 'color: pink': 'color: gray')}}"
   onclick="event.preventDefault();document.getElementById('favorite-{{$name}}-{{$model->id}}').submit()"
>
    Favorite
    {{$model->favorites_count}}
</a>
<form action="{{route($name.'.favorite', $model->id)}}" id="favorite-{{$name}}-{{$model->id}}" method="post">
    {{csrf_field()}}
    @if($model->is_favorited)
        {{method_field('DELETE')}}
    @endif
</form>
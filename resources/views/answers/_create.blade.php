<div class="card card-primary mt-2">
    <div class="card-header text-bg-dark">
        <h3 class="card-title">Your Answer</h3>
    </div>
    <div class="card-body">
        <form action="{{route('questions.answers.store', $question->slug)}}" method="post">
            @csrf
            <div class="form-group">
                <textarea class="form-control  {{$errors->has('body') ? 'is-invalid' : ''}}" id="exampleInputPassword1" name="body">
                    {{old('body')}}
                </textarea>
                @if ($errors->has('body'))
                    <div class="invalid-feedback">
                        <strong>{{$errors->first('body')}}</strong>
                    </div>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
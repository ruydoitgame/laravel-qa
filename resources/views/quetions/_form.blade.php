@csrf
<div class="card-body">
    <div class="form-group">
        <label for="exampleInputEmail1">Question title</label>
        <input type="text" value="{{old('title', $question->title)}}" class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}" id="exampleInputEmail1" name="title">
        @if ($errors->has('title'))
            <div class="invalid-feedback">
                <strong>{{$errors->first('title')}}</strong>
            </div>
        @endif
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Explain your question</label>
        <textarea class="form-control  {{$errors->has('body') ? 'is-invalid' : ''}}" id="exampleInputPassword1" name="body">
            {{old('body', $question->body)}}
        </textarea>
        @if ($errors->has('body'))
            <div class="invalid-feedback">
                <strong>{{$errors->first('body')}}</strong>
            </div>
        @endif
    </div>
</div>
<!-- /.card-body -->

<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{$buttonText}}</button>
</div>
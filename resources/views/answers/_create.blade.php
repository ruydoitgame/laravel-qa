<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3>Your answer</h3>
                </div>
                <hr>
                <form action="{{route('questions.answers.store', $question->id)}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <textarea name="body" id="" cols="30" rows="10" class="form-control {{$errors->has('body') ? 'is-invalid' : ''}}"></textarea>
                        @if ($errors->has('body'))
                            <div class="invalid-feedback">{{$errors->first('body')}}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
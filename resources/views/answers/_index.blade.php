<div class="row mt-3">
    <div class="col-md-12" v-cloak>
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{ $answers_count . " " . str_plural('Answer', $answers_count) }}</h2>
                </div>
                <hr>
                @include('layouts._message')
                @foreach($answers as $answer)
                    @include('answers._answer')

                @endforeach
            </div>
        </div>
    </div>
</div>
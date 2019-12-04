<answer :answer="{{$answer}}" home-route="{{ route('/') }}" inline-template>
    <div>
        <div class="media">
            @include('shared._vote', [
                'model' => $answer
            ])
            <div class="media-body">
                <form v-if="editing" @submit.prevent="update">
                    <div class="form-group">
                        <textarea name="" id="" cols="30" rows="5" class="form-control" v-model="body" required></textarea>
                    </div>
                    <button class="btn btn-sm btn-outline-primary" :disabled="isInvalid">Update</button>
                    <button @click="cancel" class="btn btn-sm btn-outline-secondary" type="button">Cancel</button>
                </form>
                <div v-else>
                    {{--{!!$answer->body_html !!}--}}
                    <div v-html="bodyHtml"></div>
                    <div class="row">
                        <div class="col-4">
                            <div class="ml-auto">
                                @can('update', $answer)
                                    {{--<a href="{{route('questions.answers.edit', [$question->id, $answer->id])}}" class="btn btn-sm btn-outline-info">Edit</a>--}}
                                    <a @click.prevent="edit" class="btn btn-sm btn-outline-info">Edit</a>
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
                            {{--@include('shared._author', [--}}
                                {{--'model' => $answer,--}}
                                {{--'label' => 'Answered',--}}
                            {{--])--}}
                            <user-info label="Answered" :model="{{$answer}}"></user-info>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>
</answer>
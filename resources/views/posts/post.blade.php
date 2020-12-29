@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card bg-light mb-3" style="max-width: 60%;padding:4em;margin:min(2%);">
        <div class="card-header">{{$post->title}}</div>
        <div class="card-body">
            <div class="row" style="margin-top:2px;margin-bottom:40px;">
                "<h5 class="card-title">{{$post->body}}</h5>
                <p class="card-text">{{$post->user->name}} - {{$post->created_at}}</p>
            </div>
            <div>
                <form action="/posts/{{$post->id}}/edit">
                    <button class="btn btn-primary">
                        Edit Post
                    </button>
                </form>
            </div>
            <div>
                <form action="/posts/{{$post->id}}/delete">
                    <button class="btn btn-primary">
                        Delete Post
                    </button>
                </form>
            </div>
            <hr>
            <h5 class="row">Comments:</h5>
            <div class="media" style="margin-top:10px;" id="app" v-for="comment in comments">
                <div class="media-body">
                    <h6 class="media-heading">@{{ comment.user.name }}:</h6>
                    <p>@{{comment.body}}</p>
                    <span style="color: #aaa;">on @{{comment.created_at}}</span>
                </div>
            </div>
            <div class="row">
                <h6>Write a comment</h6>
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="body" v-model="commentBox"/>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" @click.prevent="postComment">
                        Publish
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    const app = new Vue({
        el: '#app',
        data: {
            comments: {},
            commentBox: '',
            post: {!! $post->toJson() !!},
            user: {!! Auth::check() ? Auth::user()->toJson() : 'null' !!}
        },
        mounted(){
            this.getComments();
        },
        methods: {
            getComments() {
                axios.get(`/api/posts/${this.post.id}/comments`)
                    .then((response) => {
                        this.comments = response.data
                    })
                    .catch(function (error) {
                        //need to add error handle better than console log here
                        console.log(error);
                    }
                );
            },
            postComment() {
                axios.post(`/api/posts/${this.post.id}/comment`, {
                    api_token: this.user.api_token,
                    body: this.commentBox
                })
                .then((response) => {
                    this.comments.unshift(response.data);
                    this.commentBox = '';
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        }
    });
</script>
@endsection

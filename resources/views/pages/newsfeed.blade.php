@extends('layouts.app')
@section('title', 'Post Feed')

@section('scripts')
<script>
    const app = new Vue({
        el: '#app',
        data: {
            comments: {},
            commentBox: '',
            post: {!! $post->toJson() !!},
            user: {!! Auth::check() ? Auth::user()->toJson() : 'null' !!}
        },
        mounted() {
              this.getComments();
        },
        methods: {
              getComments() {
                  axios.get('/api/posts/'+this.post.id+'/comments')
                       .then((response) => {
                           this.comments = response.data
                       })
                       .catch(function (error) {
                           console.log(error);
                       }
                  );
              },
              postComment() {
                  axios.post('/api/posts/'+this.post.id+'/comment', {
                      api_token: this.user.api_token,
                      body: this.commentBox
                  })
                  .then((response) => {
                      this.comments.unshift(response.data);
                      this.commentBox = '';
                  })
                  .catch((error) => {
                      console.log(error);
                  })
              }
          }
    })
<script>
@endsection

@section('content')
<div class="card mb-4">
    <h5 class="display-3" style="margin:auto;width:8em;">Recent Posts</h5>
    <div class="list-group list-group-flush" style="text-align:center">
        <div style="width:110em;padding-left:min(20%)">
        @if(count($posts)>0)
            @foreach($posts as $post)
            <div class="card bg-light mb-3" style="max-width: 60%;padding:4em;margin:min(2%);">
                <div class="card-header">{{$post->title}}</div>
                <div class="card-body">
                    <h6 href="#" class="card-title">{{$post->body}}</h6>
                    <p class="card-text">{{$post->user->name}} - {{$post->created_at}}</p>
                    
                </div>
                <div class="media" style="margin-top:20px;" v-for="comment in comments">
                    <div class="media-body">
                        <h4 class="media-heading">@{{comment.user.name}} said...</h4>
                        <p>
                            @{{comment.body}}
                        </p>
                        <span style="color: #aaa;">on @{{comment.created_at}}</span>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
        </div>
    </div>
</div>
{{$posts->links()}}
@endsection
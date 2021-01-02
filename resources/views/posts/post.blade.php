@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card bg-light mb-3" style="max-width: 60%;padding:4em;margin:min(2%);">
        <div class="card-header">{{$post->title}}</div>
        <div class="card-body">
            <div class="row" style="margin-top:2px;margin-bottom:40px;">
                <img src="{{ asset('images/' . $post->image) }}" height="400" width="547"/>
                <h5 class="card-title">{{$post->body}}</h5>
                <p class="card-text">{{$post->user->name}} - {{$post->created_at}}</p>
            </div>
            <div style="display:inline-flexbox;text-align:center;">
                <form action="/posts/{{$post->id}}/edit">
                    <button class="btn btn-primary">
                        Edit Post
                    </button>
                </form>
                <form action="/posts/{{$post->id}}/delete">
                    <button class="btn btn-primary">
                        Delete Post
                    </button>
                </form>
            </div>
            <hr>
            <h5 class="row">Comments:</h5>
            <div id="comments">
                <div class="media" style="margin-top:10px;" v-for="comment in comments">
                    <div class="media-body">
                        <h6 class="media-heading" >@{{comment.user.name}}:</h6>
                        <p>@{{comment.body}}</p>
                        <span style="color: #aaa;">on @{{comment.created_at}}</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <h6>Write a comment</h6>
                <form method="POST" id="commentForm">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-group" name="commentBody" id="commentBody"/>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" name="submit" id="submit"> {{-- @click="postComment" --}}
                            Publish
                        </button>
                    </div>
                </form>
                <span id="commentMessage"></span>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
// $(document).ready(function(){
//     $('#commentForm').on('submit', function(event){
//         event.preventDefault();
//         var form_data = $(this).serialize();
//         $.ajax({
//             url:"api/posts/"+this.post.id+"/store",
//             method:"POST",
//             data:form_data,
//             dataType:"JSON",
//             success:function(data){
//                 if(data.error != ''){
//                     $.('#commentForm')[0].reset();
//                     $.('commentMessage').html(data.error);
//                 }
//             }
//         })
//     })
// })
    const app = new Vue({
        el: '#app',
        data: {
            comments: {},
            commentBody: '',
            post: {!! $post->toJson() !!}
        },
        mounted(){
            this.getComments()
        },
        methods: {
            getComments() {
                axios.get("/api/posts/"+this.post.id+"/index")
                    .then((response) => {
                        this.comments = response.data;
                    })
                    .catch(response => {
                        //need to add error handle better than console log here
                        console.log(response);
                    }
                );
            },
            postComment() {
                axios.post("/api/posts/"+this.post.id+"/store", {
                    body: this.commentBody
                })
                .then((response) => {
                    this.comments.push(response.data);
                    this.commentBody = '';
                })
                .catch(response => {
                    console.log(response);
                });
                // axios({
                //     method: 'post',
                //     body: document.getElementById("commentBody"),
                //     url: '/api/posts/'+this.post.id+'/store'
                // })
                // .then(function (response) {
                //     console.log(response);
                // })
                // .catch(function (error) {
                //     console.log(error);
                // });
            }
        }
    });
</script>
@endsection

@extends('layouts.app')

@section('title', 'Show')
    
@section('content')    
    
    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                        <h3 class="card-title">Title: {{$post->title}}</h3>
                        <h6 class="card-text">ID: {{$post->id}}</h6>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Content: {{$post->content}}</li>
                            <li class="list-group-item">Slug: {{$post->slug}}</li>                        
                        </ul>
                        <ul class="list-group list-group-flush">
                            
                            <li class="list-group-item">Tags: 
                                @foreach ($post->tags as $tag)
                                    {{$tag->name}}
                                @endforeach
                            </li>
                                                   
                        </ul>
                        @if (count($post->comments) > 0)
                        <div class="mt-3" id="comments">
                            <h3>Comments</h3>
                            <table class="table">
                                <tbody>
                                    @foreach ($post->comments as $comment)
                                        <tr>
                                            <td>{{$comment->content}}</td>
                                            <td>
                                                @if(!$comment->approved)
                                                <form action="{{route('admin.comments.update', $comment->id)}}" method="POST">
                                                    @csrf
                                                    @method("PATCH")
                                                    <button type="submit" class="btn btn-info">Approve</button>
                                                </form>
                                                @else 
                                                    Approvato
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{route('admin.comments.destroy', $comment->id)}}" method="POST">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif


                        <div class="card-body">
                            <a href="{{route("admin.posts.index")}}" class="card-link"><button type="button" class="btn btn-info">Back to table</button></a>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    
@endsection
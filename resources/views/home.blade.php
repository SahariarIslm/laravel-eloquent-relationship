@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <h2>Add A Post</h2>
                    <form action="{{route('post.store')}}" method="post">
                        
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{csrf_field()}}
                        <label for="">Enter Form Title</label><br>
                        <input type="text" name="title" class="form-control">

                        <label for="">Enter Form Description</label><br>
                        <textarea name="description" class="form-control" rows="5"></textarea>

                        <label for="">Category</label><br>
                        <select class="form-control select2" name="category_id" >
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>

                        <label for="">Tags</label><br>
                        <select class="form-control select2" name="tags[]" multiple>
                            @foreach($tags as $tag)
                            <option value="{{$tag->id}}">{{$tag->name}}</option>
                            @endforeach
                        </select>

                        <br>
                        <br>

                        <input type="submit" name="submit" value="Publish" class="btn btn-default">
                    </form>
                    
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel panel-body">
                    <!-- <h2>All Posts</h2> -->
                    <h2>My Posts</h2>

                    {{-- @foreach($posts as $post) --}}
                    @foreach($user->posts as $post)
                    <div class="panel panel-body mt-2">
                        <h3>{{ $post->title }}</h3>
                        <h4>in <mark>
                            <small>
                                <a href="{{route('category',$post->category->id)}}">{{ $post->category->name}}</a>
                            </small>
                        </mark></h4>
                        <h5>by <small>{{ $post->user->name }}</small> </h5>
                        <div>
                            {{$post->description}}
                        </div>
                        <hr>
                        <div>
                            @foreach($post->tags as $tag)
                                <span class="badge badge-primary" >
                                    {{$tag->name}}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $('.select2-multi').select2();
    $('.select2').select2();
</script>
@endsection
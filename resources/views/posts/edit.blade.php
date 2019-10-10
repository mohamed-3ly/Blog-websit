@extends('layouts.master')

@section('content')

<div class="row mt-2">
    <div class="col-md-9 offset-md-2">
        <h3>Edit post form</h3>
        <hr>
    <form action="{{ '/posts/' . $post->id }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <img src="{{asset('storage/coverImages/' . $post->image)}}" alt="" height="200" width="350">

            <div class="form-group">
                <label for="coverImage">Update Cover Image</label>
                <input type="file" name="coverImage" id="coverTmage" class="form-control-file">
            </div>
            

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{$post->title}}">
            </div>
   
            <div class="form-group">
               <label for="body">Body</label>
               <textarea name="body" id="body" cols="30" rows="4" class="form-control">{{$post->body}}</textarea>
           </div>

   
            <div class="form-group">
               <button type="submit" class="btn btn-primary">Update</button>
           </div>
         </form>
    </div>
</div>

@endsection
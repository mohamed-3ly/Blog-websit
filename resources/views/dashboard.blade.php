@extends('layouts.master')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-19">
            <div class="card">
                <div class="card-header">Your Posts</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                    <br>
                    

                    <div class="col-md-9">
                            <div class="row">
                                <div class="row">
                                    @foreach($posts as $post)
                                        <div class="col-md-4">
                                            <div class="card mb-3" style="min-width: 15rem;">
                                                <div class="card-header bg-dark text-white">
                                                        {{$post->title}}
                                                </div>
                                                <div class="card-body">
                                                    <div class="card-title">
                                                        <h4> {{$post->title}}</h4>
                                                    </div>
                                                    <div class="card-text">
                                                        {{$post->body}}
                                                    </div>
                                                    <hr>
                                                    <a href="{{'/posts/' .$post->id }}" class="btn btn-primary"> Show More</a>
                                                </div>    
                                            </div>
                                       </div>
                                    @endforeach
                                </div>
                 
                            </div>
                            
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

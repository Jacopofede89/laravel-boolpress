@extends('layouts.main-layout')
@section('content')
<div class="create">
    <h2>Update</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

<div class="col-md-6">
    <form action="{{route('update', $post -> id)}}" method="POST">

        @method("post")
        @csrf

        <label for="title">Titolo:</label>
        <input class="form-control" type="text" name="title" placeholder="Titolo" value="{{$post -> title}}"><br>

        <label for="description">Descrizione:</label>
        <input class="form-control" type="text" name="description" placeholder="Descrizione" value="{{$post -> description}}"><br>

        <select name="category_id">
            @foreach ($categories as $category)
                <option value="{{$category -> id}}"
                    @if ($category -> id == $post -> category -> id)
                        selected
                    @endif
                    
                    >{{$category -> name}}</option>
            @endforeach
        </select>
        <h4>Tags</h4>
            @foreach ($tags as $tag)
                <input type="checkbox" name="tags[]" value="{{$tag -> id}}"
                    @foreach ($post -> tags as $post_tag)
                        @if ($tag -> id == $post_tag)
                            checked
                        @endif
                        
                    @endforeach
        
                     > {{$tag -> name}} <br>
            @endforeach

        <input type="submit" value="CREATE">
    </form>
</div>
<h3><a href="{{ route('home') }}">Home</a></h3>
</div>
    
@endsection
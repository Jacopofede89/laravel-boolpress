@extends('layouts.main-layout')
@section('content')
<div class="create">
    <h2>Crea il tuo post!</h2>

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
    <form action="{{ route('store') }}" method="POST">

        @method("post")
        @csrf

        <label for="title">Titolo:</label>
        <input class="form-control" type="text" name="title" placeholder="Titolo"><br>

        <label for="author">Autore:</label>
        <input class="form-control" type="text" name="author" placeholder="Autore"><br>

        <label for="date">Data:</label>
        <input class="form-control" type="date" name="release_date"><br>

        <label for="description">Descrizione:</label>
        <input class="form-control" type="text" name="description" placeholder="Descrizione"><br>

        <select name="category_id">
            @foreach ($categories as $category)
                <option value="{{$category -> id}}">{{$category -> name}}</option>
            @endforeach
        </select>

        <input type="submit" value="CREATE">
    </form>
</div>
<h3><a href="{{ route('home') }}">Home</a></h3>
</div>
    
@endsection
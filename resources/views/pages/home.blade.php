@extends('layouts.main-layout')
@section('content')
<a class="text-secondary" href="{{ route('create')}}">CREATE NEW POST</a>
    @auth
        <h1>{{ Auth::user() -> name}} </h1>
        <a class="btn btn-secondary" href="{{ route('logout') }}">LOGOUT</a>
    @else
        <h1>If you wanne see my site you have to login/register</h1>
    @endauth

    @guest

<div class="col-md-6">
    <div class="register">
    <h2>Register</h2>
    <form action="{{ route('register') }}" method="POST">

        @method('POST')
        @csrf

        <label for="name">Name</label>
        <input class="form-control" type="text" name="name"> <br>

        <label for="email">E-mail</label>
        <input class="form-control" type="text" name="email"> <br>

        <label for="password">Password</label>
        <input class="form-control" type="password" name="password"> <br>
        
        <label for="password_confirmation">Password confirm</label>
        <input class="form-control" type="password" name="password_confirmation"> <br>
        <br>
        <input type="submit" value="REGISTER">

    </form>
</div>

    <br><hr class="bg-white"><br>

    <div class="login">
    <h2>Login</h2>
        <form action="{{ route('login') }}" method="POST">

            @method('POST')
            @csrf

            <label for="email">E-mail</label>
            <input class="form-control" type="text" name="email"> <br>
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password"> <br>
            <br>
            <input type="submit" value="LOGIN">

        </form>
    </div>
    @else

    <h2>List post:</h2>

    <div class="container">

        @foreach ($posts as $post)

            <div class="list-post">

                <p>Titolo: {{$post -> title}}</p>

                <p>Autore: {{$post -> author}}</p>

                <p>Data: {{$post -> release_date}}</p>

                <p>Categoria:{{$post -> category -> name}}</p>

                <p class="description-post">Descrizione: {{$post -> description}}</p>
    
            </div>

        @endforeach

    </div>
</div>
    @endguest

@endsection

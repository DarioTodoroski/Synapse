@extends('layouts.app')

@section('content')
<h2>Форма</h2>

<form method="POST" action="/contact">
    @csrf

    <input type="text" name="full_name" placeholder="Име и презиме"><br><br>

    <input type="text" name="company" placeholder="Компанија"><br><br>

    <input type="email" name="email" placeholder="Емаил"><br><br>

    <input type="text" name="phone" placeholder="Телефонски број"><br><br>

    <button type="submit">Испрати</button>
</form>

@endsection
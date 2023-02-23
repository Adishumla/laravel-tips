<form method="post" action="/login">
    <div>
        <label for="email">Email</label>
        <input name="email" id="email" type="email" />
    </div>
    <div>
        <label for="password">Password</label>
        <input name="password" id="password" type="password" />
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <button type="submit">Login</button>
</form>

{{-- @include('errors') --}}

<?php
$resturants = DB::table("resturants")->get();
$categories = DB::table("category")->get();
$prices = DB::table("prices")->get();
$users = DB::table("users")->get();
?>

@foreach ($resturants as $resturant)
    @foreach ($users as $user)
        @if ($resturant->user_id == $user->id)
            <h1>{{ $user->name }}</h1>
        @endif
    @endforeach
    @foreach ($categories as $category)
        @if ($resturant->category_id == $category->id)
            <h2>{{ $category->name }}</h2>
        @endif
    @endforeach
    @foreach ($prices as $price)
        @if ($resturant->price_id == $price->id)
            <h3>{{ $price->price }}</h3>
        @endif
    @endforeach
    <h4>{{ $resturant->name }}</h4>
    <h5>{{ $resturant->city }}</h5>
    <br>
@endforeach


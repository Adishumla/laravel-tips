<?php
$user = Auth::user();

echo "Welcome, " . $user->name . "!";

$prices = DB::table("prices")->get();
$categories = DB::table("category")->get();
$user_id = Auth::user()->id;
?>

<a href="/logout">Logout</a>
<br>

<h1>Enter your resturant!</h1>
<form action="/resturant" method="POST">
    @csrf
    <div class="form-group">
        <label for="category_id">Category</label>
        <select name="category_id" id="category_id" class="form-control">
            @foreach ($categories as $category)
            <option value="{{ (int) $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <input type="hidden" name="user_id" value={{ $user_id }}>
        <label for="price_id"></label>
        <select name="price_id" id="price_id" class="form-control">
            @foreach ($prices as $price)
                <option value={{ (int) $price->id }}>{{ $price->price }}</option>
            @endforeach
        </select>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control">
        <label for="city">city</label>
        <input type="text" name="city" id="city" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

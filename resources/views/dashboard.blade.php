<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body>


<?php
$user = Auth::user();
$prices = DB::table("prices")->get();
$categories = DB::table("category")->get();
$user_id = Auth::user()->id;
?>
<div class="mx-auto m-4">
<p class="text-lg">Welcome, {{ Auth::user()->name }}!</p>
<a href="/logout" class="inline-block py-2 px-4 border border-gray-400 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200">Logout</a>
</div>
<h1 class="text-3xl text-center">Add a Resturant</h1>

    <form action="/resturant" method="POST" class="max-w-lg mx-auto">
        @csrf
        <div class="mb-4">
          <label for="category_id" class="block font-bold mb-2">Category</label>
          <select name="category_id" id="category_id" class="form-select block w-full py-2 px-3 border border-gray-400 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-200 focus:border-transparent">
            @foreach ($categories as $category)
              <option value="{{ (int) $category->id }}">{{ $category->name }}</option>
            @endforeach
          </select>
        </div>
        <input type="hidden" name="user_id" value={{ $user_id }}>
        <div class="mb-4">
          <label for="price_id" class="block font-bold mb-2">Price</label>
          <select name="price_id" id="price_id" class="form-select block w-full py-2 px-3 border border-gray-400 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-200 focus:border-transparent">
            @foreach ($prices as $price)
              <option value="{{ (int) $price->id }}">{{ $price->price }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-4">
          <label for="name" class="block font-bold mb-2">Name</label>
          <input type="text" name="name" id="name" class="form-input block w-full py-2 px-3 border border-gray-400 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-200 focus:border-transparent">
        </div>
        <div class="mb-4">
          <label for="city" class="block font-bold mb-2">City</label>
          <input type="text" name="city" id="city" class="form-input block w-full py-2 px-3 border border-gray-400 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-200 focus:border-transparent">
        </div>
        <div class="mt-6">
          <button type="submit" class="inline-block py-2 px-4 border border-gray-400 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200">
            Submit
          </button>
        </div>
    </form>


@vite('resources/js/app.js')
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>index</title>
</head>
<body class="">
    <?php
    $user = Auth::user();
    $resturants = DB::table("resturants");

    // Check if the filter form has been submitted
    if (request()->has("category")) {
        $categoryId = request()->input("category");
        // Filter the restaurants based on the selected category id
        if ($categoryId != "all") {
            $resturants = $resturants->where("category_id", $categoryId);
        }
    }

    $resturants = $resturants->get();
    $categories = DB::table("category")->get();
    $prices = DB::table("prices")->get();
    $users = DB::table("users")->get();
    $likes = DB::table("likes")->get();
    $descriptions = DB::table("descriptions")->get();
    $user_id = Auth::id();
    ?>
@if (Auth::check())
<a href="/dashboard" class="inline-block py-2 px-4 border border-gray-400 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200">Dashboard</a>
<a href="/logout" class="inline-block py-2 px-4 border border-gray-400 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200">Logout</a>
@else
<div class="flex  justify-start items-start">
    <form method="post" action="/login" class="col-md-6 offset-md-3 m-2">
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
            <input name="email" id="email" type="email" class="form-input block w-full py-2 px-3 border border-gray-400 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-200 focus:border-transparent" />
        </div>
        <div class="mb-6">
            <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
            <input name="password" id="password" type="password" class="form-input block w-full py-2 px-3 border border-gray-400 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-200 focus:border-transparent" />
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 w-full">Login</button>
        <button type="button" class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 w-full mt-1" onclick="window.location.href='/register'">Register</button>
</form>
</div>
@endif
@include('errors')
{{-- filter based on category --}}
<form method="get" action="">
    <label for="category">Filter by category:</label>
    <select name="category" id="category">
        <option value="all">All</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    <button type="submit">Filter</button>
</form>


<section class="flex flex-wrap justify-center">
    @foreach ($resturants as $resturant)
      <div class="bg-white border border-5 shadow-lg rounded-md p-4 m-2 w-96 h-auto hover:shadow-2xl transition duration-500 ease-in-out">
        @foreach ($users as $user)
          @if ($resturant->user_id == $user->id)
            <h6 class="text-sm font-thin mb-2">{{ $user->name }}</h6>
          @endif
        @endforeach
        @foreach ($prices as $price)
          @if ($resturant->price_id == $price->id)
            <h6 class="text-sm font-thin mb-2">{{ $price->price }}</h6>
          @endif
        @endforeach
        <h4 class="text-2xl font-bold mb-2">{{ $resturant->name }}</h4>
        @foreach ($categories as $category)
          @if ($resturant->category_id == $category->id)
            <h5 class="text-lg font-semibold mb-2">{{ $category->name }}</h5>
          @endif
        @endforeach
        <h5 class="text-lg font-light mb-2">{{ $resturant->city }}</h5>
        @foreach ($descriptions as $description)
        @if ($resturant->description_id == $description->id)
        <p class="text-lg font-normal mb-2 overflow-ellipsis overflow-hidden" style="word-wrap: break-word;">{{ Str::limit($description->description, 100) }}</p>
        @endif
        @endforeach
                <h5 class="text-lg font-semibold mb-2">Likes: {{ $resturant->likes }}</h5>
        <form action="/like" method="post">
            @if(Auth::check())
            <input type="hidden" name="user_id" value={{ $user_id }}>
            @endif
            <input type="hidden" name="resturant_id" value={{ $resturant->id }}>
            @csrf
            @if(Auth::check())
            @if($user_id && $likes->where('user_id', $user_id)->where('resturant_id', $resturant->id)->count() > 0)
            <button type="submit" disabled class="px-4 py-2 bg-gray-700 text-white rounded-md hover:bg-gray-700 w-full">Liked</button>
            @else
            <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 w-full">Like</button>
            @endif
            @endif
        </form>
        <br>
      </div>
    @endforeach
</section>
    @vite('resources/js/app.js')
</body>
</html>


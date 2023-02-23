<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body class="">
    <?php
    $resturants = DB::table("resturants")->get();
    $categories = DB::table("category")->get();
    $prices = DB::table("prices")->get();
    $users = DB::table("users")->get();
    ?>

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
        </form>
    </div>

{{-- @include('errors') --}}
<section class="flex flex-wrap justify-center">
    @foreach ($resturants as $resturant)
    {{-- limit 4 divs --}}
      <div class="bg-white border border-5 shadow-lg rounded-md p-4 m-2 w-64 flex flex-col justify-between">
        @foreach ($users as $user)
          @if ($resturant->user_id == $user->id)
            <h3 class="text-2xl font-bold mb-2">{{ $user->name }}</h3>
          @endif
        @endforeach
        @foreach ($categories as $category)
          @if ($resturant->category_id == $category->id)
            <h2 class="text-xl font-semibold mb-2">{{ $category->name }}</h2>
          @endif
        @endforeach
        <h4 class="text-lg font-semibold mb-2">{{ $resturant->name }}</h4>
        <h5 class="text-lg font-semibold mb-2">{{ $resturant->city }}</h5>
        <br>
      </div>
    @endforeach
</section>

    @vite('resources/js/app.js')

</body>
</html>


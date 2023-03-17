<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>




# Resturant Tips:
This is an webapp made by Adam and Emma where you as a user can post your best resturant tips, view others tips and even vote for the ones you think are the best ones. Amazing! You will never have to think about where you should eat again, just look at the tips and you will for sure know where to eat.

# Instructions:
1. Clone down the repo
2. npm install
3. composer install
4. run npm run dev
5. php artisan serve to run the project

# Code review:
- Tips use [DatabaseSeeder](https://laravel.com/docs/10.x/seeding) and [factories](https://laravel.com/docs/10.x/eloquent-factories) to automate putting data in your db.
- Add error handling on register.blade.php
- Add validate on Controllers\LoginController.php 
    ``` PHP
    $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    ```
- Make [relationships](https://laravel.com/docs/10.x/migrations#foreign-key-constraints) this way so you can use MySQL error handling.
    ``` PHP
    Schema::table('posts', function (Blueprint $table) {
        $table->foreignId('user_id')->constrained();
    });
    ```
- Make use of [resource controllers](https://laravel.com/docs/10.x/controllers#resource-controllers) for example to auth
- This controllers don´t make any thing. Consider removing them.  
    - CategorieController
    - PostResturantController
    - PriceController
- Be consequence with [@CSRF](https://laravel.com/docs/10.x/csrf) in yours form.
- Category migration be in plural `category` to `categorys`.
- Some tests are missing the "use RefreshDatabse" which is good practice to use.
- Make shore to use `test_` in the name of every test function in the test file.
- Comment in `DB_CONNECTION` and `DB_DATABASE` in [phpunit.xml](phpunit.xml). So it doesn't use MySQL.
- Welcome.blade.php not in use.
- LikesController.php instead of only redirect back to index use an `withError()`. 
- LikesController.php on line 27 write 
    ``` PHP
    Like::create([
        'user_id' => $user_id,
        'resturant_id' => $resturant_id,
    ]);
    ```
    instedd of:
    ``` PHP
    $likes = Like::create([
        'user_id' => $user_id,
        'resturant_id' => $resturant_id,
    ]);
    ```
- Follow Laravels recommendations on [logging out an user](https://laravel.com/docs/10.x/authentication#logging-out)
- Move all the logic in [index.blade.php and dashboard.blade.php](https://laravel.com/docs/10.x/views#passing-data-to-views) to an controller if possible.
- Be sure when to use `redirect()->intended()` and only [redirect()](https://laravel.com/docs/10.x/redirects)
- In your prices table consider to change price column to int. It makes it easier to use it in blade file when it is a int type
- In resturant migration filen add `unique()` to name colum so it looks like this `$table->string('name')->unique()`. It means that there cannot be more than one restaurant with that name.
- You have miss out comment. Are you stil using it?

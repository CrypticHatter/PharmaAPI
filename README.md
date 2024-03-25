# Pharmacy API setup guide

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## How to run this project locally

1. Clone this laravel repository using `git clone <ssh-key or http url>`.
2. Create a `.env` using a copy of existing `.env.example` file. You can simply copy it using `cp .env.example .env` command.
3. Generate `APP_KEY` for your application through laravel app key generator `php artisan key:generate`
4. Then run `composer install` command to install all the dependencies of this application.
5. Create sqlite database and run already defined database migrations and seeders. `php artisan migrate --seed` will run all the migrations and seeders in same command.
6. As the last step use `php artisan serve` command run your application on PHP development server. You can also run this application locally using xampp local server.

## How to do API testing with postman

_This API part is developed using Laravel Sanctum package, it provides a lightweight authentication system for APIs_

1. Open your postman web app and postman client agent for local testing.
2. Then click on `collection` tab at the left panel and click on `import` button to import the the postman collection file `Pharmacy API.postman_collection.json`.
3. After that, click on `environments` tab and import provided environment file `Pharmacy API.postman_environment.json` and change `base_url` according to your local server.
4. Login to the app using your required user role (seeders has created a user in each user role).

### Sample user credentials in seeder

```
    Owner - email: owner@example.com
            password: password

    Manager - email: owner@example.com
              password: password

    Cashier - email: owner@example.com
              password: password
```

5. When you login using above credentials, the loginendpoint will return a user token. You should add that token value to the `user_token` environmental variable.
6. Then you can access other endpoints of the app using that token and permissions related to the user role.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

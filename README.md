# Komilitona Case Study Ticketing Portal and APIs

This webpoprtal has been created in context of a tutorial for the lecture process management and application systems, which is held at the chair for information systems and information management @ WWU Münster.

Customers can register themselves at the portal and order tickets. They are able to see their orders and if they have been processed by fictional CRM and payment providers.

The goal for students is to integrate this portal with two other application systems by using an IPaaS-service like zapier.com.

Students receive read-access to the ``orders`` database table and can then use two API endpoints to send the relevant data to the other systems for further processing. The API endpoints are also part of this tool.

## Installation

Since the portal is based on laravel, you should make sure to meet the laravel [installation requirements](http://laravel.com/docs/5.1).

* Rename the ``.env.example`` file to ``.env`` and set up your API key and database access
* Set up the default admin user in ``/database/seeds/UserTableSeeder.php``

* Run ``composer install`` to pull laravel and the associated requirements
* Run ``bower install`` to pull bootstrap and jQuery
* Run ``composer dumpautoload`` just in case
* Run ``php artisan migrate`` to create the database tables
* Run ``php artisan db:seed`` to seed your database
* Run ``php artisan key:generate`` to set your cipher key

If everything went well, the site is available at the ``/public`` directory.

Be happy.

## Used frameworks

* [Laravel](http://laravel.com/) 5.1
* [Bootstrap](http://getbootstrap.com/)


### License

The komilitona case study portal is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

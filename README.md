## Installation Steps and Basic instructions
- step 1: download zip file from github and unzip the files or clone the file from the repository link: 

-step 2: navigate into the root folder through the command prompt and type in >> composer install : this downloads all dependencies.

-step 3: create a database manually with the name: ice_and_fire  

-step 4: run the command >> php artisan migrate : this runs the migration and create database tables

-step 5: run >> php artisan serve : this serves the project and now ready for connections

## Book Api Urls

-POST >> http://localhost:8000/api/v1/books --create a book
-GET >>  http://localhost:8000/api/v1/books --get all books
-GET >> http://localhost:8000/api/v1/books/:id --get a single book
-PATCH >> http://localhost:8000/api/v1/books/:id --update a book
-DELETE >> http://localhost:8000/api/v1/books/:id --delete a book
-GET >> http://localhost:8000/external-book?name=:nameOfBook -- get a book from an external api by passing in the url param of the book name.

## Testing Resources
-- navigate from the root folder >> reports/index.html to see test coverage results

You can also configure xdebug on your localdrive before running tests by following instructions at >> 
https://xdebug.org
-- for testing simply run the command on the root folder >> ./vendor/bin/phpunit

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

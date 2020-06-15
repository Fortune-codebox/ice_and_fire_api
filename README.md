## Installation Steps and Basic instructions
- step 1: download zip file from github and unzip the files or clone the file from the link: https://github.com/Fortune-codebox/ice_and_fire_api

- step 2: navigate into the root folder through the command prompt and type in >> composer install : this downloads all dependencies.

- step 3: make sure you have installed xampp, wampp or mampp depending on operating system and usages then create a database manually with the name: ice_and_fire  

- step 4: run the command >> php artisan migrate : this runs the migration and create database tables

- step 5: run >> php artisan serve : this serves the project and now ready for connections

## Book Api Urls
 
-POST >> http://localhost:8000/api/v1/books --create a book <br>
-GET >> http://localhost:8000/api/v1/books/:id --get a single book <br>
-PATCH >> http://localhost:8000/api/v1/books/:id --update a book <br>
-DELETE >> http://localhost:8000/api/v1/books/:id --delete a book <br>
-GET >> http://localhost:8000/external-book?name=:nameOfBook -- get a book from an external api by passing in the url param of the book name. <br>
-GET >>  http://localhost:8000/api/v1/books --get all books <br>

## Filters
 filters for search include: name, country, publisher and release_date <br>
 to Test with postman select params or url params then pass in the keys and values or you can easily type in the url and the necessary keys and values<br>
 url: http://localhost:8000/api/v1/books <br>
 query with the key and value = ?name=harry potter i.e key= name, value= harry potter <br>

-GET >> http://localhost:8000/api/v1/books?name=:nameOfBook, filters and return a response message of all the records with the searched name<br>
-GET >> http://localhost:8000/api/v1/books?country=:countryName, filters and return a response message of all the records with the searched country <br>
-GET >> http://localhost:8000/api/v1/books?publisher=:publisherName, filters and return a response message of all the records with the searched publisher <br>
-GET >> http://localhost:8000/api/v1/books?release_date=:releaseDate, filters and return a response message of all the records with the searched release date <br>

you can also use more than one or all four of them together to filter further the data records you wanna receive example <br>
-GET >> http://localhost:8000/api/v1/books?name=:nameOfBook&country=:countryName&publisher=:publisherName&release_date=:releaseDate <br>

Note: 
- If you are testing with postman when creating a new book make sure to click on body and select >> form-data i.e create a new record <br>
- if you are updating a book make sure to click on body and select >> x-www-form-urlencoded i.e update an existing record <br>
- the url >> http://localhost:8000/api/v1/books >> returns all books existing except you pass in a valid searchables of any of the four filters listed above .i.e http://localhost:8000/api/v1/books?name=Harry Potter&release_date=2020-10-03 <br> 
- Don't forget to add '&' symbol when adding multiple searchables to filter the records further <br>
- Make sure the search values are valid and existing else it will return an empty data array <br>
- if filtering with all four searchables, all values must be correct for it to filter out properly<br>

## Testing Resources
- Navigate from the root folder >> tests/Feature/BookControllerTest.php to see the tests written <br>
- navigate from the root folder >> reports/index.html to see test coverage results <br>

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

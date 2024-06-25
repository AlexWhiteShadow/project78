### How to run (with Docker):

* Run ```docker-compose up -d```
* Go inside the container ```docker exec -it project78_php-apache_1 bash```
* Run ```composer install```
* Run ```php artisan migrate```
* Run ```chmod 777 -R storage```
* Run ```php artisan optimize```
* Open [http://localhost/api/test-documentation](http://localhost/api/test-documentation)
* To exit, press ctrl+D and run ```docker-compose down```
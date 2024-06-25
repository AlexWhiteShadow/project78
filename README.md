### How to run (with Docker):

* Clone the repo [https://github.com/AlexWhiteShadow/project78](https://github.com/AlexWhiteShadow/project78)
* Create file ".env" and paste the content from file ".env.example"
* Run ```docker-compose up -d```
* Run ```composer install```
* Go inside the container ```docker exec -it project78_php-apache_1 bash```
* Run ```php artisan migrate```
* Run ```chmod 777 -R storage```
* Run ```php artisan optimize```
* Open [http://localhost/api/test-documentation](http://localhost/api/test-documentation)
* To exit, press ctrl+D and run ```docker-compose down```
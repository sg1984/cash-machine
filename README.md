# Cash Machine
<br>
<br>
This is a project of an API using Laravel Lumen to make cash withdraw.
<br>
<br>
The project was developed using [Laravel Lumen](https://lumen.laravel.com/), so it has to be installer using Homestead or the specification recommended to install Laravel, that is:<br>
* PHP >= 7.0<br>
* OpenSSL PHP Extension<br>
* PDO PHP Extension<br>
* Mbstring PHP Extension<br>
<br>
No database is required, for now, maybe in the future...<br> 
<br>
There is a `.env.example` file, change it's name to `.env`, this is a standard behaviour from Laravel environment.<br>
<br>
Clone or download the project and enter in the folder created:<br>
```
cd /path-to/wherever-the/code-is
```  
<br>
<br>
Clone or download the project and run the composer installer:<br>
```
composer install
```  
<br>
<br>
Now, if you want to know if it is all working, you can run the tests:<br>
```
vendor/bin/phpunit
```  
<br>
<br>
This is a API, so to better test it, there is a [Postman](https://www.getpostman.com/) collection [here](https://www.getpostman.com/collections/b90c0447290628ba144b) to use the endpoints.<br> 
The collection is based to use the address http:://localhost:8000.<br>
If a different address or port is used, the address must be changed at Postman as well.<br>
```
php -S localhost:8000 -t public
```    
<br>
<br>
If there is any question/suggestion, please let me know. Can be via issue or via [Sandro Galina](https://sandrogallina.com/).<br>
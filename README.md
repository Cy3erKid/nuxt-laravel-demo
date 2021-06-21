# nuxt-laravel-demo
Demo Laravel api &amp; NuxtJs

1. Api Authen use Laravel Santumc
2. CSRF Prevent -> Laravel Santumc
3. Nuxt Js
4. Bootstrap Vue -> done
5. DayJs -> done
6. Numeral -> done
7. Paginate -> done
8. Search -> done
9. Export File -> done (excel file. another file Please see doc in Lib PHP)

Feature  (Not Complete)<br>
2 Table Request in one page<br>
Multiple language (NuxtJs)


=== HOW TO RUN APPLICATION ===
Laravel
1. cd api && composer install
2. php artisan key:generate
3. if run with command php artisan serve make sure add SANCTUM_STATEFUL_DOMAINS=127.0.0.1:8000 in .env file
** not run php artisan migrate

IF USE DOCKER. RUN COMMAND
1. docker-compose build
2. docker-compose up -d
3. api run is runing http://localhost/api (nginx config root path /var/www/html/api/public)
4. phpmyadmin run port 8990 | user : root : password: password


Nuxt
cd app && npm install

==== Import Database ====
1. db1
2. db2


User for test login
Email: admin@gmail.com
Pass: password@1234

Nuxt Module & Plugin

https://bootstrap-vue.org/
https://www.npmjs.com/package/js-file-download
https://vuex.vuejs.org/
http://numeraljs.com/
https://dev.auth.nuxtjs.org/ -> v5
https://axios.nuxtjs.org/    ->  5.13.6
https://github.com/nuxt-community/dayjs-module -> ^1.4.0
https://vuelidate.js.org/


PHP Libraries

https://docs.laravel-excel.com/3.1/getting-started/
https://phpspreadsheet.readthedocs.io/en/latest/
https://laravel.com/docs/8.x/sanctum#introduction

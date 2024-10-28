cách cài 
b1: clone project
b2: cd vào app_english_backend_laravel
b3: docker-compose up -d
b4: docker ps 
b5: exec vào docker có post: 5173: docker exec -it ID sh
b6: composer install 
b7: tạo file .env chỗ connect DB đầy đủ thông tin như sau
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=refactorian
DB_USERNAME=refactorian
DB_PASSWORD=refactorian

b8, đứng trong docker chạy migrate: php artisan migrate
b9: chạy các seeder tạo data fake :php artisan db:seed --class=ProductTableSeeder
b10: check lại api xem chạy được chưa 

# back-end-app-english

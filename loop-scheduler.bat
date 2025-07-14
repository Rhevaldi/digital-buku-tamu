@echo off
cd /d C:\xampp\htdocs\digital-buku-tamu

:loop
echo [%DATE% %TIME%] Menjalankan Laravel scheduler...
php artisan schedule:run
timeout /t 60
goto loop

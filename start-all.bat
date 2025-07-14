@echo off
title Start Venom Bot & Laravel Scheduler

:: Buka tab pertama - Menjalankan Venom Bot
start "Venom Bot" cmd /k "cd /d C:\xampp\htdocs\digital-buku-tamu && node index.js"

:: Buka tab kedua - Menjalankan Laravel Scheduler terus-menerus
start "Laravel Scheduler" cmd /k "cd /d C:\xampp\htdocs\digital-buku-tamu && loop-scheduler.bat"

echo Semua proses sudah dijalankan di jendela terpisah.

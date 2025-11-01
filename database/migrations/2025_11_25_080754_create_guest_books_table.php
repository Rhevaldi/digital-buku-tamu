<?php

use App\Models\User;
use App\Models\Bidang;
use App\Models\Purpose;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tamu', function (Blueprint $table) {
            $table->id();

            // Relasi ke bidang tujuan tamu
            $table->foreignIdFor(Bidang::class)
                ->constrained('bidangs')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            // Relasi ke tujuan kedatangan (purpose)
            $table->foreignIdFor(Purpose::class)
                ->nullable()
                ->constrained('purposes')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            // Relasi opsional ke user (petugas penerima / pencatat)
            $table->foreignIdFor(User::class)
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            // Informasi tamu
            $table->string('nama', 100);
            $table->text('description')->nullable();
            $table->string('no_identitas', 50)->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_wa', 20)->nullable();
            $table->string('instansi', 100)->nullable();

            // Keterangan kedatangan
            $table->string('keperluan', 100)->nullable(); // bisa redundant dengan purpose, tapi tetap disimpan untuk input bebas
            $table->string('hari', 20)->nullable();
            $table->date('tanggal');
            $table->time('jam_masuk');
            $table->time('jam_keluar')->nullable();

            // Status dan notifikasi
            $table->boolean('sudah_dikirim_notif')->default(false);

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tamu');
    }
};

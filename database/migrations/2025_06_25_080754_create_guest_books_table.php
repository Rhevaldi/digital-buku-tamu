<?php
use App\Models\Bidang;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->foreignIdFor(Bidang::class)
                ->constrained('bidangs')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
                 $table->string('nama', 100);
            $table->string('no_ktp', 50)->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_wa', 20)->nullable();
            $table->string('keperluan', 50)->nullable();
            $table->string('hari', 20)->nullable();
            $table->date('tanggal');
            $table->time('jam_masuk');
            $table->time('jam_keluar')->nullable();
            $table->boolean('sudah_dikirim_notif')->default(false);
            $table->timestamps();

             // Foreign key constraint
            // $table->foreign('bidang_id')->references('id')->on('bidangs')->onDelete('cascade');
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

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Purpose>
 */
class PurposeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            $table->id();
            $table->string('name')->unique(); // contoh: "Kunjungan", "Rapat", "Mengantar Surat"
            $table->text('description')->nullable();
            $table->timestamps();
        ];
    }
}

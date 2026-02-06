<?php

namespace Database\Factories;

use App\Models\Pengumuman;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pengumuman>
 */
class PengumumanFactory extends Factory
{
    protected $model = Pengumuman::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'judul' => fake('id_ID')->sentence(5),
            'isi' => fake('id_ID')->paragraphs(3, true),
            'tanggal' => fake()->dateTimeBetween('-1 month', 'now'),
            'user_id' => User::factory(),
        ];
    }
}

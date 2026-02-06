<?php

namespace Database\Factories;

use App\Models\Kegiatan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kegiatan>
 */
class KegiatanFactory extends Factory
{
    protected $model = Kegiatan::class;

    /**
     * Daftar kegiatan desa yang umum
     */
    protected static array $kegiatanList = [
        'Gotong Royong Pembersihan Lingkungan',
        'Posyandu Balita',
        'Rapat Koordinasi RT/RW',
        'Pembangunan Jalan Desa',
        'Penyuluhan Pertanian',
        'Pelatihan UMKM',
        'Vaksinasi Massal',
        'Kerja Bakti Pemakaman',
        'Renovasi Balai Desa',
        'Festival Budaya Desa',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tanggalMulai = fake()->dateTimeBetween('-1 month', '+1 month');
        $tanggalSelesai = fake()->dateTimeBetween($tanggalMulai, '+2 months');

        return [
            'nama_kegiatan' => fake()->randomElement(static::$kegiatanList),
            'deskripsi' => fake('id_ID')->paragraph(3),
            'tanggal_mulai' => $tanggalMulai,
            'tanggal_selesai' => $tanggalSelesai,
            'progres' => fake()->numberBetween(0, 100),
            'user_id' => User::factory(),
        ];
    }

    /**
     * Indicate that the kegiatan is completed.
     */
    public function completed(): static
    {
        return $this->state(fn(array $attributes) => [
            'progres' => 100,
        ]);
    }

    /**
     * Indicate that the kegiatan is not started.
     */
    public function notStarted(): static
    {
        return $this->state(fn(array $attributes) => [
            'progres' => 0,
        ]);
    }
}

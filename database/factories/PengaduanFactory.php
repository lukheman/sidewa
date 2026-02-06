<?php

namespace Database\Factories;

use App\Models\Masyarakat;
use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pengaduan>
 */
class PengaduanFactory extends Factory
{
    protected $model = Pengaduan::class;

    /**
     * Contoh isi pengaduan
     */
    protected static array $pengaduanList = [
        'Jalan rusak di depan rumah sudah lama tidak diperbaiki',
        'Lampu jalan di RT 05 mati sudah 2 minggu',
        'Saluran air tersumbat menyebabkan banjir saat hujan',
        'Sampah menumpuk di TPS tidak diangkut',
        'Pohon tumbang menghalangi jalan',
        'Keributan warga pada malam hari mengganggu ketenangan',
        'Air PDAM keruh dan berbau',
        'Jembatan penyeberangan rusak berbahaya',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'isi_pengaduan' => fake()->randomElement(static::$pengaduanList) . '. ' . fake('id_ID')->paragraph(),
            'tanggal_pengaduan' => fake()->dateTimeBetween('-1 month', 'now'),
            'status' => fake()->randomElement(['pending', 'proses', 'selesai', 'ditolak']),
            'masyarakat_id' => Masyarakat::factory(),
            'user_id' => fake()->boolean(70) ? User::factory() : null,
        ];
    }

    /**
     * Indicate that the pengaduan is pending.
     */
    public function pending(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'pending',
            'user_id' => null,
        ]);
    }

    /**
     * Indicate that the pengaduan is in process.
     */
    public function inProcess(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'proses',
        ]);
    }

    /**
     * Indicate that the pengaduan is completed.
     */
    public function completed(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'selesai',
        ]);
    }

    /**
     * Indicate that the pengaduan is rejected.
     */
    public function rejected(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'ditolak',
        ]);
    }
}

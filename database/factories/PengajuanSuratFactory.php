<?php

namespace Database\Factories;

use App\Models\JenisSurat;
use App\Models\Masyarakat;
use App\Models\PengajuanSurat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PengajuanSurat>
 */
class PengajuanSuratFactory extends Factory
{
    protected $model = PengajuanSurat::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = fake()->randomElement(['diajukan', 'diproses', 'siap_ambil', 'selesai', 'ditolak']);

        return [
            'tanggal_pengajuan' => fake()->dateTimeBetween('-1 month', 'now'),
            'status' => $status,
            'keterangan' => $status === 'ditolak'
                ? fake('id_ID')->sentence()
                : (fake()->boolean(30) ? fake('id_ID')->sentence() : null),
            'masyarakat_id' => Masyarakat::factory(),
            'jenis_surat_id' => JenisSurat::factory(),
            'user_id' => in_array($status, ['diproses', 'siap_ambil', 'selesai', 'ditolak'])
                ? User::factory()
                : null,
        ];
    }

    /**
     * Indicate that the pengajuan is submitted.
     */
    public function submitted(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'diajukan',
            'user_id' => null,
        ]);
    }

    /**
     * Indicate that the pengajuan is in process.
     */
    public function inProcess(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'diproses',
        ]);
    }

    /**
     * Indicate that the surat is ready to pickup.
     */
    public function readyToPickup(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'siap_ambil',
        ]);
    }

    /**
     * Indicate that the pengajuan is completed.
     */
    public function completed(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'selesai',
        ]);
    }

    /**
     * Indicate that the pengajuan is rejected.
     */
    public function rejected(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'ditolak',
            'keterangan' => fake('id_ID')->sentence(),
        ]);
    }
}

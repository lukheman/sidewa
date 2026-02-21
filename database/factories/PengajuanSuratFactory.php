<?php

namespace Database\Factories;

use App\Enum\StatusPengajuanSurat;
use App\Models\JenisSurat;
use App\Models\Masyarakat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PengajuanSurat>
 */
class PengajuanSuratFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = fake()->randomElement(['pending', 'diproses', 'disetujui', 'ditolak']);

        return [
            'tanggal_pengajuan' => fake()->dateTimeBetween('-1 month', 'now'),
            'status' => $status,
            'keterangan' => fake()->optional(0.3)->sentence(),
            'masyarakat_id' => Masyarakat::factory(),
            'jenis_surat_id' => JenisSurat::factory(),
            'user_id' => in_array($status, ['diproses', 'disetujui', 'ditolak'])
                ? User::factory()
                : null,
        ];
    }

    /**
     * Indicate that the pengajuan is pending.
     */
    public function pending(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'pending',
            'user_id' => null,
        ]);
    }

    /**
     * Indicate that the pengajuan is diproses.
     */
    public function diproses(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'diproses',
            'user_id' => User::factory(),
        ]);
    }

    /**
     * Indicate that the pengajuan is disetujui.
     */
    public function disetujui(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'disetujui',
            'user_id' => User::factory(),
        ]);
    }

    /**
     * Indicate that the pengajuan is ditolak.
     */
    public function ditolak(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'ditolak',
            'user_id' => User::factory(),
        ]);
    }
}

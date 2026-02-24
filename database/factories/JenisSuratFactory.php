<?php

namespace Database\Factories;

use App\Models\JenisSurat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JenisSurat>
 */
class JenisSuratFactory extends Factory
{
    protected $model = JenisSurat::class;

    /**
     * Daftar jenis surat yang umum di desa
     */
    protected static array $jenisSuratList = [
        ['nama_surat' => 'Surat Keterangan Tidak Mampu', 'keterangan' => 'Surat keterangan untuk warga kurang mampu'],
        ['nama_surat' => 'Surat Keterangan Berkelakuan Baik', 'keterangan' => 'Surat keterangan berkelakuan baik dari desa'],
        ['nama_surat' => 'Surat Keterangan Belum Menikah', 'keterangan' => 'Surat keterangan status belum menikah'],
    ];

    protected static int $index = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jenisSurat = static::$jenisSuratList[static::$index % count(static::$jenisSuratList)];
        static::$index++;

        return [
            'nama_surat' => $jenisSurat['nama_surat'],
            'keterangan' => $jenisSurat['keterangan'],
        ];
    }
}

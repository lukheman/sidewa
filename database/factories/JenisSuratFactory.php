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
        ['nama_surat' => 'Surat Keterangan Domisili', 'keterangan' => 'Surat keterangan tempat tinggal warga'],
        ['nama_surat' => 'Surat Keterangan Tidak Mampu', 'keterangan' => 'Surat keterangan untuk warga kurang mampu'],
        ['nama_surat' => 'Surat Keterangan Usaha', 'keterangan' => 'Surat keterangan untuk keperluan usaha'],
        ['nama_surat' => 'Surat Pengantar KTP', 'keterangan' => 'Surat pengantar pembuatan KTP'],
        ['nama_surat' => 'Surat Pengantar KK', 'keterangan' => 'Surat pengantar pembuatan Kartu Keluarga'],
        ['nama_surat' => 'Surat Keterangan Kelahiran', 'keterangan' => 'Surat keterangan untuk kelahiran'],
        ['nama_surat' => 'Surat Keterangan Kematian', 'keterangan' => 'Surat keterangan untuk kematian'],
        ['nama_surat' => 'Surat Keterangan Pindah', 'keterangan' => 'Surat keterangan pindah domisili'],
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

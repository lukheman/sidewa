<?php

namespace Database\Seeders;

use App\Enum\Role;
use App\Models\JenisSurat;
use App\Models\Kegiatan;
use App\Models\Masyarakat;
use App\Models\Pengaduan;
use App\Models\PengajuanSurat;
use App\Models\Pengumuman;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123'),
            'role' => Role::ADMIN,
        ]);

        // Create kepala desa user
        $kepalaDesa = User::factory()->create([
            'name' => 'Kepala Desa',
            'email' => 'kepaladesa@gmail.com',
            'password' => Hash::make('password123'),
            'role' => Role::KEPALA_DESA,
        ]);

        // Create pelayanan user
        $pelayanan = User::factory()->create([
            'name' => 'Pelayanan',
            'email' => 'pelayanan@gmail.com',
            'password' => Hash::make('password123'),
            'role' => Role::PELAYANAN,
        ]);

        // Create more pelayanan users
        $pelayananUsers = User::factory(3)->pelayanan()->create();
        $pelayananUsers->push($pelayanan);

        // Create jenis surat
        $jenisSurats = JenisSurat::factory(3)->create();

        // Create masyarakat demo (for testing login)
        Masyarakat::factory()->create([
            'nik' => '1234567890123456',
            'nama' => 'Budi Santoso',
            'email' => 'budi@gmail.com',
            'alamat' => 'Jl. Merdeka No. 10, Desa Sidoasih',
            'phone' => '081234567890',
            'password' => Hash::make('password123'),
        ]);

        // Create more masyarakat
        $masyarakats = Masyarakat::factory(4)->create();

        // Create pengumumans
        Pengumuman::factory(5)->create(['user_id' => $admin->id]);
        Pengumuman::factory(3)->create(['user_id' => $kepalaDesa->id]);

        // Create kegiatans
        Kegiatan::factory(3)->completed()->create(['user_id' => $admin->id]);
        Kegiatan::factory(5)->create(['user_id' => $pelayananUsers->random()->id]);

        // Create pengaduans
        foreach ($masyarakats->take(10) as $masyarakat) {
            Pengaduan::factory()->create([
                'masyarakat_id' => $masyarakat->id,
                'user_id' => $pelayananUsers->random()->id,
            ]);
        }

        // Create pengajuan surats
        foreach ($masyarakats->take(15) as $masyarakat) {
            PengajuanSurat::factory()->create([
                'masyarakat_id' => $masyarakat->id,
                'jenis_surat_id' => $jenisSurats->random()->id,
                'user_id' => fake()->boolean(70) ? $pelayananUsers->random()->id : null,
            ]);
        }
    }
}

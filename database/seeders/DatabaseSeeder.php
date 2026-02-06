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

        // Create kades user
        $kades = User::factory()->create([
            'name' => 'Kepala Desa',
            'email' => 'kades@gmail.com',
            'password' => Hash::make('password123'),
            'role' => Role::KADES,
        ]);

        // Create staff users
        $staffUsers = User::factory(3)->staff()->create();

        // Create jenis surat
        $jenisSurats = JenisSurat::factory(10)->create();

        // Create masyarakat
        $masyarakats = Masyarakat::factory(20)->create();

        // Create pengumumans
        Pengumuman::factory(5)->create(['user_id' => $admin->id]);
        Pengumuman::factory(3)->create(['user_id' => $kades->id]);

        // Create kegiatans
        Kegiatan::factory(3)->completed()->create(['user_id' => $admin->id]);
        Kegiatan::factory(5)->create(['user_id' => $staffUsers->random()->id]);

        // Create pengaduans
        foreach ($masyarakats->take(10) as $masyarakat) {
            Pengaduan::factory()->create([
                'masyarakat_id' => $masyarakat->id,
                'user_id' => $staffUsers->random()->id,
            ]);
        }

        // Create pengajuan surats
        foreach ($masyarakats->take(15) as $masyarakat) {
            PengajuanSurat::factory()->create([
                'masyarakat_id' => $masyarakat->id,
                'jenis_surat_id' => $jenisSurats->random()->id,
                'user_id' => fake()->boolean(70) ? $staffUsers->random()->id : null,
            ]);
        }
    }
}

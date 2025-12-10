<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Package;
use Illuminate\Support\Str;

class PackageSlugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua paket yang slug-nya kosong
        $packages = Package::whereNull('slug')->get();

        foreach ($packages as $package) {
            // Buat slug dari nama paket
            $slug = Str::slug($package->name);
            
            // Pastikan slug unik
            $originalSlug = $slug;
            $count = 1;
            while (Package::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }

            // Update slug
            $package->slug = $slug;
            $package->save();
        }

        $this->command->info('Slug for existing packages has been updated!');
    }
}
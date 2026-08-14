<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class New106QuestionsSeeder extends Seeder
{
    public function run()
    {
        // 1. Matikan pengecekan Foreign Key sementara
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // 2. Bersihkan tabel
        DB::table('assessment_answers')->truncate();
        DB::table('questions')->truncate();

        // 3. Aktifkan kembali pengecekan Foreign Key
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 4. Baca file CSV
        $csvPath = public_path('IMT Soal Terbaru 106 Pertanyaan ver 2 csv.csv');
        if (!file_exists($csvPath)) {
            $this->command->error("File CSV tidak ditemukan: $csvPath");
            return;
        }

        $drivers = DB::table('drivers')->pluck('id', 'name')->toArray();
        // Karena ada perbedaan huruf besar/kecil di Excel vs DB, kita buat versi lowercase
        $driversLower = [];
        foreach ($drivers as $name => $id) {
            $driversLower[strtolower($name)] = $id;
        }
        
        // Pastikan driver 'general' ada
        if (!isset($driversLower['general'])) {
            $generalId = DB::table('drivers')->insertGetId([
                'name' => 'general',
                'description' => 'General Driver',
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $driversLower['general'] = $generalId;
        }

        $subDrivers = DB::table('sub_drivers')->pluck('id', 'name')->toArray();
        $subDriversLower = [];
        foreach ($subDrivers as $name => $id) {
            $subDriversLower[strtolower(trim($name))] = $id;
        }

        $file = fopen($csvPath, 'r');
        $header = fgetcsv($file); // Skip header

        $questions = [];
        while (($row = fgetcsv($file)) !== false) {
            if (empty(array_filter($row))) continue;

            $idSoal = $row[0];
            $driverName = trim($row[1]);
            $subComposite = trim($row[2]);
            $jenis = trim($row[3]);
            $pertanyaan = trim($row[4]);

            // Tentukan Driver ID
            $driverId = null;
            if (stripos($driverName, 'General') !== false) {
                $driverId = $driversLower['general'];
            } else {
                $dKey = strtolower($driverName);
                if (isset($driversLower[$dKey])) {
                    $driverId = $driversLower[$dKey];
                }
            }

            // Tentukan Sub Driver ID
            $subDriverId = null;
            if ($subComposite !== '-' && $subComposite !== '') {
                $sKey = strtolower(str_replace([' ', '-'], '_', $subComposite));
                // juga ubah DB keys
                $matched = false;
                foreach ($subDriversLower as $dbKey => $dbId) {
                    $normDbKey = strtolower(str_replace([' ', '-'], '_', $dbKey));
                    if ($normDbKey === $sKey) {
                        $subDriverId = $dbId;
                        $matched = true;
                        break;
                    }
                }
                
                if (!$matched) {
                    $this->command->warn("Sub Driver tidak ditemukan di DB: $subComposite (dicari sebagai $sKey)");
                }
            }

            // Tentukan Tipe
            $type = 'core';
            if (stripos($jenis, 'Normal') !== false) {
                $type = 'core';
            } elseif (stripos($jenis, 'Reverse') !== false) {
                $type = 'reverse core';
            } elseif (stripos($jenis, 'Consistency') !== false) {
                $type = 'module_consistency';
            } elseif (stripos($jenis, 'Authenticity') !== false) {
                $type = 'module_authenticity';
            }

            $questions[] = [
                'id' => $idSoal,
                'question_text' => $pertanyaan,
                'type' => $type,
                'driver_id' => $driverId,
                'sub_driver_id' => $subDriverId,
                'order' => $idSoal,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        fclose($file);

        // 5. Insert ke tabel questions
        DB::table('questions')->insert($questions);

        $this->command->info("Berhasil mengimpor " . count($questions) . " soal baru dari CSV.");
    }
}

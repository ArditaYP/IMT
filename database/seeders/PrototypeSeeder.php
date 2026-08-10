<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Driver;
use App\Models\SubDriver;
use App\Models\Question;

class PrototypeSeeder extends Seeder
{
    public function run(): void
    {
        $json = file_get_contents(base_path('temp_seed.json'));
        $data = json_decode($json, true);

        // 1. Prepare Drivers Map
        $drivers = Driver::all()->keyBy('name');
        
        $driverMap = [];
        foreach ($drivers as $d) {
            $driverMap[strtolower($d->name)] = $d->id;
        }

        if (!isset($driverMap['general'])) {
            $gen = Driver::create([
                'name' => 'General'
            ]);
            $driverMap['general'] = $gen->id;
        }

        // 2. Insert SubDrivers
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        Question::truncate();
        SubDriver::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        $subDriverMap = [];
        
        foreach ($data['s'] as $driverKey => $subList) {
            if (!isset($driverMap[$driverKey])) continue;
            
            $driverId = $driverMap[$driverKey];
            foreach ($subList as $subData) {
                $sd = SubDriver::create([
                    'driver_id' => $driverId,
                    'name' => $subData['key'],
                ]);
                $subDriverMap[$driverKey . '_' . $subData['key']] = $sd->id;
            }
        }

        // 3. Insert Questions
        foreach ($data['q'] as $q) {
            $driverId = $driverMap[$q['driver']] ?? null;
            $subDriverId = null;

            if (isset($q['subComposite']) && $q['subComposite']) {
                $subDriverId = $subDriverMap[$q['driver'] . '_' . $q['subComposite']] ?? null;
            }

            Question::create([
                'id' => $q['id'],
                'driver_id' => $driverId,
                'sub_driver_id' => $subDriverId,
                'question_text' => $q['text'],
                'type' => $q['type'] ?? 'core',
                'order' => $q['id'],
                'is_active' => true,
            ]);
        }

        $this->command->info('Prototype questions and sub-drivers seeded successfully!');
    }
}

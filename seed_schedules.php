<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Specialist;
use App\Models\SpecialistSchedule;
use App\Models\User;

$specialists = Specialist::with('user')->get();

foreach ($specialists as $specialist) {
    // Ensure they have the Staff role if they are a specialist
    if ($specialist->user) {
        $specialist->user->assignRole('Staff');
        
        // Let's also update their password to 'password' and email to something uniform if needed
        // But the user asked to create users for them.
        echo "Found specialist: " . $specialist->user->name . "\n";
    }

    // Generate schedules 0 (Sunday) to 6 (Saturday)
    for ($day = 0; $day <= 6; $day++) {
        SpecialistSchedule::updateOrCreate(
            [
                'specialist_id' => $specialist->id,
                'day_of_week' => $day,
            ],
            [
                'start_time' => '09:00:00',
                'end_time' => '22:00:00',
                'is_working' => true, // default all days working, they can edit later
            ]
        );
    }
}

echo "Schedules seeded successfully.\n";

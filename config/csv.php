<?php

return [
    'debug' => true,
    'conf' => [
        'localPath' => env('CSV_LOCAL_PATH', '/csv'),
        'employee' => env('EMPLOYEE_CSV_FILE', 'sotr.csv'),
        'division' => env('DIVISION_CSV_FILE', 'division.csv'),
        'status' => env('STATUS_CSV_FILE', 'abbr.csv'),
    ]
];

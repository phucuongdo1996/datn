<?php

use Maatwebsite\Excel\Excel;

return [
    'exports'            => [

        /*
        |--------------------------------------------------------------------------
        | CSV Settings
        |--------------------------------------------------------------------------
        |
        | Configure e.g. delimiter, enclosure and line ending for CSV exports.
        |
        */
        'csv'        => [
            'delimiter'              => ',',
            'enclosure'              => '"',
            'line_ending'            => PHP_EOL,
            'use_bom'                => true,
            'include_separator_line' => false,
            'excel_compatibility'    => false,
        ],
    ],
];

<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SchemaService
{
public function getColumnTypes($tableName)
{
    $columnTypes = [];
    $columns = Schema::getColumnListing($tableName); // Use getColumnListing to get column names

    foreach ($columns as $column) {
        $columnType = DB::getSchemaBuilder()->getColumnType($tableName, $column); // Get the column type
        dump($columnType);
        $columnTypes[$column] = $this->mapToFormType($columnType); // Map to form input type and add to array

    }
    return $columnTypes;
}

    // Map the database types to HTML form input types
    protected function mapToFormType($dbType)
    {
        $formTypes = [
            'varchar' => 'text',
            'bigint' => 'number',
            'int' => 'number',
            'text' => 'textarea',
            'boolean' => 'checkbox',
            'timestamp' => 'datetime-local',
            'date' => 'date',
            'float' => 'number',
            'tinyint' => 'checkbox',
        ];

        // Default to 'text' if no specific mapping is found
        return $formTypes[$dbType] ?? 'text';
    }
}

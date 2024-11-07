<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class GetAttributeColumnOfEloquentModel
{

    public static function getAttributeColumnOfEloquentModel(Model $model, $with_timestamp = true, $with_id = false)
    {
        $table = $model->getTable();
        // dd($table);
        $columns = DB::select("SHOW COLUMNS FROM " . $table);


        $attributes = [];

        foreach ($columns as $column) {
            // Skip column if it's a primary key and $with_id is false
            $isPrimaryKey = $column->Key === 'PRI';
            $isTimestamp = in_array($column->Field, ['created_at', 'updated_at', 'deleted_at']);
            if ($isPrimaryKey && !$with_id) {
                continue;
            }

            // Skip column if it's a timestamp and $with_timestamp is false
            if ($isTimestamp && !$with_timestamp) {
                continue;
            }

            $attributes[$column->Field] = $column->Type;
        }

        return $attributes;
    }
    public static function getForeignKeyReferenceModel(Model $model)
    {
        $foreignKeys = DB::table('INFORMATION_SCHEMA.KEY_COLUMN_USAGE')
            ->where('TABLE_NAME', $model->getTable())
            ->where('TABLE_SCHEMA', env('DB_DATABASE')) // Use the database name from your config
            ->whereNotNull('REFERENCED_TABLE_NAME') // If this is not null, it's a foreign key
            ->get();
        $foreignKeysColumns = [];
        foreach ($foreignKeys as $foreignKeys) {
            $foreignKeysColumns[] = $foreignKeys->COLUMN_NAME;
        }
        return $foreignKeysColumns;
    }
}

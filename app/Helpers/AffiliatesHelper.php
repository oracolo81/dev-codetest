<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use Exception;

class AffiliatesHelper
{
    /**
     * @var string|null
     */
    private static $error = null;

    public static function loadJson(string $fileName, bool $associative = false): mixed
    {
        $json = '';

        try {
            $json = file_get_contents(storage_path("app/$fileName"));
            // few changes to make the file a valid JSON
            $json = str_replace("}\n{", "}, {", $json);
            if (substr($json, 0, 1) !== '[' && substr($json, -1) !== ']') {
                $json = "[" . $json . "]";
            }
        } catch (Exception $e) {
            self::$error = $e->getMessage();
            return null;
        }

        return json_decode($json, $associative);
    }

    public static function distance($lat1, $lon1, $lat2, $lon2)
    {
        $radius = 6371; // radius of Earth in km

        $theta = $lon1 - $lon2;
        $centralAngle = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $centralAngle = acos($centralAngle);

        $distance = round($radius * $centralAngle);

        return $distance;
    }

    public static function sortBy($items, $field, $order = 'asc')
    {
        $sorted = [];

        foreach ($items as $item) {
            $key = $item->{$field};
            if (is_numeric($key) && array_key_exists($key, $sorted)) {
                $key++;
            }
            $sorted[$key] = $item;
        }

        if ($order === 'asc') {
            ksort($sorted);
        } else if ($order === 'desc') {
            krsort($sorted);
        }

        return $sorted;
    }

    public static function getError()
    {
        return self::$error;
    }
}

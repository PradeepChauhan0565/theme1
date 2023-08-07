<?php

// Check if value is float or string

use App\Models\MstParameter;
use App\Models\MstParameterList;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

function is_string_float($string)
{
    if (is_numeric($string)) {
        $val = $string + 0;
        return is_float($val);
    }
    return false;
}






function copyTableFromProduction($table_name, $prm_key)
{
    DB::table($table_name)->truncate();
    $para_data_32 = DB::table($table_name)->pluck($prm_key);
    $columns = DB::getSchemaBuilder()->getColumnListing('mst_parameter_lists');
    $para_data_44 = DB::connection('chetak')->table($table_name)->whereNotIn($prm_key, $para_data_32)->get();
    DB::unprepared('SET IDENTITY_INSERT ' . $table_name . ' ON');
    $data = [];
    foreach ($para_data_44 as $pd) {
        foreach ($columns as $c) {
            $data[$c] = $pd->$c;
        }
        DB::table($table_name)->insert($data);
    }
    DB::unprepared('SET IDENTITY_INSERT ' . $table_name . ' OFF');
    return "inserted successfully";
}


function stringToArray($data)
{
    $data1 = str_replace("'", '', $data);
    $data2 = str_replace(',', ' ', $data1);
    return preg_split('/\s+/', $data2);
}

function compressImage($source, $image_name, $quality, $path)
{
    // Get image info 
    $imgInfo = getimagesize($source);
    $mime = $imgInfo['mime'];

    // Create a new image from file 
    switch ($mime) {
        case 'image/jpeg':
            $image = imagecreatefromjpeg($source);
            break;
        case 'image/png':
            $image = imagecreatefrompng($source);
            break;
        case 'image/gif':
            $image = imagecreatefromgif($source);
            break;
        default:
            $image = imagecreatefromjpeg($source);
    }
    $full_path = public_path() . '/' . $path;
    if (!File::isDirectory($full_path)) {
        File::makeDirectory($full_path, 0777, true, true);
    }
    $destination = $full_path . '/' . $image_name;
    // Save image 
    imagejpeg($image, $destination, $quality);

    // Return compressed image 
    $path_arr = ['full_path' => $destination, 'store_path' => $path . '/' . $image_name];
    return $path_arr;
}

function dropdown($table, $condition = null)
{
    return DB::table($table)->when($condition, function ($q) use ($condition) {
        $q->whereRaw($condition);
    })->get();
}

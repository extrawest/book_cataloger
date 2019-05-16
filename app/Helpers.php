<?php

namespace App;

use Illuminate\Support\Facades\Storage;

/**
 * Class Helpers
 *
 * @package App
 */
class Helpers
{
    /**
     * Function for recording all action in log file
     *
     * @param $data
     */
    public function logRecorder($data)
    {
        $line = '';
        $uploadFolder = date('Y') . '/' . date('m') . '/';
        $path = 'logs/' . $uploadFolder . date('Y-m-d') . '.txt';
        foreach ($data->toArray() as $key => $datum) {
            $line .= $key . ": " . $datum . ", ";
        }

        $line = date('Y-m-d H:m:i') . " " . $line . "\n";

        if (file_exists(storage_path('app/' . $path))) {
            Storage::append($path, $line);
        } else {
            Storage::put($path, $line);
        }
    }
}
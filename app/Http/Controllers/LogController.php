<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

class LogController extends Controller
{
    public function show()
    {
        $logFilePath = storage_path('logs/laravel.log');

        if (File::exists($logFilePath)) {
            // Get the content of the log file
            $logContent = File::get($logFilePath);

            // Convert the log content to an array of lines (equivalent to split from some other languages)
            $logLines = explode("\n", $logContent);

            // Get the last ten lines
            $lastTenLines = array_slice($logLines, -10);

            // Join the array of lines back into a string (equivalent to concat from some other languages)
            $lastTenLines = implode("\n", $lastTenLines);    

            return view('logs', ['logContent' => $lastTenLines]);
        }

        // If there's an error or the file doesn't exist
        return view('logs', ['logContent' => 'Unable to read the log file.']);
    }

    public function showAll()
    {
        $logFilePath = storage_path('logs/laravel.log');

        if (File::exists($logFilePath)) {
            // file reading
            $logContent = File::get($logFilePath);

            return view('logs', ['logContent' => $logContent]);
        }

        // if error
        return view('logs', ['logContent' => 'Unable to read the log file.']);
    }
}

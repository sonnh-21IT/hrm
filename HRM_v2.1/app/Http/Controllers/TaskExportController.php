<?php

namespace App\Http\Controllers;

use App\Exports\TasksExport;
use Maatwebsite\Excel\Facades\Excel;

class TaskExportController extends Controller
{
    public function exportTasks()
    {
        return Excel::download(new TasksExport(), 'tasks.xlsx');
    }
}
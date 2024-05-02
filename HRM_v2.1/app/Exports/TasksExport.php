<?php

namespace App\Exports;

use App\Models\Task;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TasksExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $tasks = Task::all();

        $modifiedTasks = $tasks->map(function ($task) {
            $priority = '';
            switch ($task->priority) {
                case 1:
                    $priority = 'Cao';
                    break;
                case 2:
                    $priority = 'Trung bình';
                    break;
                case 3:
                    $priority = 'Thấp';
                    break;
            }
    
            $status = '';
            switch ($task->status) {
                case 1:
                    $status = 'Mới tạo';
                    break;
                case 2:
                    $status = 'Đang làm';
                    break;
                case 3:
                    $status = 'Hoàn thành';
                    break;
                case 4:
                    $status = 'Tạm hoãn';
                    break;
            }
    
            return [
                $task->id,
                $task->project->name,
                $task->person->full_name,
                $task->start_time,
                $task->end_time,
                $priority,
                $task->name,
                $task->description,
                $status,
            ];
        });
    
        return $modifiedTasks;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Project',
            'Person',
            'Start Time',
            'End Time',
            'Priority',
            'Name',
            'Description',
            'Status',
        ];
    }
}
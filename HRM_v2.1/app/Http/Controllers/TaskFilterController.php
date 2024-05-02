<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TaskService;
use App\Services\ProjectService;
use App\Services\PersonService;
use App\Services\CompanyService;

class TaskFilterController extends Controller
{
    protected $taskService;
    protected $projectService;
    protected $personService;
    protected $companyService;

    public function __construct(TaskService $taskService, ProjectService $projectService, PersonService $personService, CompanyService $companyService)
    {
        $this->taskService = $taskService;
        $this->projectService = $projectService;
        $this->personService = $personService;
        $this->companyService = $companyService;
    }

    /**
     * Display a listing of the resource.
     */
    public function filter(Request $request)
    {
        $companyId = $request->input('company_id');
        $projectId = $request->input('project_id');
        $personId = $request->input('person_id');
        $status = $request->input('status');
        $priority = $request->input('priority');

        $tasks = $this->taskService->filter($companyId, $projectId, $personId, $status, $priority, 10);

        $projects = $this->projectService->getAll();
        $people = $this->personService->getAll();
        $companies = $this->companyService->getAll();

        return view('pages.tasks',['tasks' => $tasks, 'projects' => $projects, 'people' => $people, 'companies' => $companies ,'oldCompanyId' => $companyId,
        'oldProjectId' => $projectId,
        'oldPersonId' => $personId,
        'oldStatus' => $status,
        'oldPriority' => $priority,]);
    }
}

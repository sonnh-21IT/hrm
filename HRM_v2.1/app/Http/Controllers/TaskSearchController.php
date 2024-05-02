<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TaskService;
use App\Services\ProjectService;
use App\Services\PersonService;
use App\Services\CompanyService;

class TaskSearchController extends Controller
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
    public function searchByName(Request $request)
    {
        $name = $request->input('name');

        $tasks = $this->taskService->searchByName($name,10);

        $projects = $this->projectService->getAll();
        $people = $this->personService->getAll();
        $companies = $this->companyService->getAll();

        return view('pages.tasks',['tasks' => $tasks, 'projects' => $projects, 'people' => $people, 'companies' => $companies, 'oldName' => $name]);
    }
}

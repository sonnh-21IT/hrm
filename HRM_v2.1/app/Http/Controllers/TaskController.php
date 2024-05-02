<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TaskService;
use App\Services\ProjectService;
use App\Services\PersonService;
use App\Services\CompanyService;

class TaskController extends Controller
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
    public function index()
    {
        $tasks = $this->taskService->paginate(10);
        $projects = $this->projectService->getAll();
        $people = $this->personService->getAll();
        $companies = $this->companyService->getAll();

        return view('pages.tasks',['tasks' => $tasks, 'projects' => $projects, 'people' => $people, 'companies' => $companies ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $result = $this->taskService->create($request->all());

        if(!$result){
            return redirect()->back()->with('error', 'Đã xảy ra lỗi!');
        }

        return redirect()->route('task.index')->with('success', 'Đã thêm thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $result = $this->taskService->update($id,$request->all());

        if(!$result){
            return redirect()->back()->with('error', 'Đã xảy ra lỗi!');
        }
        
        return redirect()->route('task.index')->with('success', 'Đã cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->taskService->delete($id);

        if(!$result){
            return redirect()->back()->with('error', 'Đã xảy ra lỗi!');
        }
        
        return redirect()->route('task.index')->with('success', 'Đã xóa thành công!');
    }
}

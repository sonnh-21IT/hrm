<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProjectService;
use App\Services\CompanyService;
use App\Services\PersonService;

class ProjectController extends Controller
{

    protected $projectService;
    protected $companyService;
    protected $personService;

    public function __construct(ProjectService $projectService, CompanyService $companyService, PersonService $personService)
    {
        $this->projectService = $projectService;
        $this->companyService = $companyService;
        $this->personService = $personService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = $this->projectService->paginate(10);
        $companies = $this->companyService->getAll();
        $people = $this->personService->getAll();

        return view('pages.projects',['projects' => $projects,'companies' => $companies,'people'=>$people]);
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
        $result = $this->projectService->create($request->all());

        if(!$result){
            return redirect()->back()->with('error', 'Đã xảy ra lỗi!');
        }

        try{
            $result->people()->sync($request->input('people',[]));  
        }catch(QueryException $e){
            Session::flash('error', 'Người tham gia chưa được thêm vào');
        } 
        return redirect()->route('project.index')->with('success', 'Đã thêm thành công!');
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
    public function update(Request $request,String $id)
    {
        $project = $this->projectService->update($id, $request->all());

        if(!$project){
            return redirect()->back()->with('error', 'Đã xảy ra lỗi!');
        }
        
        try{
            $project->people()->sync($request->input('people',[]));  
        }catch(QueryException $e){
            Session::flash('error', 'Người tham gia chưa được thanh đổi');
        } 
        return redirect()->route('project.index')->with('success', 'Đã thêm thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->projectService->delete($id);

        if(!$result){
            return redirect()->back()->with('error', 'Đã xảy ra lỗi!');
        }
        
        return redirect()->route('project.index')->with('success', 'Đã xóa thành công!');
    }
}

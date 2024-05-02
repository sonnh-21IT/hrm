<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DepartmentService;
use App\Services\CompanyService;

class DepartmentController extends Controller
{
    protected $departmentService;
    protected $companyService;

    public function __construct(DepartmentService $departmentService, CompanyService $companyService)
    {
        $this->departmentService = $departmentService;
        $this->companyService = $companyService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = $this->departmentService->paginate(1);
        $companies = $this->companyService->getAll();

        return view('pages.departments',['departments' => $departments,'companies'=>$companies]);
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
        $result = $this->departmentService->create($request->all());

        if(!$result){
            return redirect()->back()->with('error', 'Đã xảy ra lỗi!');
        }

        return redirect()->route('department.index')->with('success', 'Đã thêm thành công!');
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
        $result = $this->departmentService->update($id,$request->all());

        if(!$result){
            return redirect()->back()->with('error', 'Đã xảy ra lỗi!');
        }
        return redirect()->route('department.index')->with('success', 'Đã cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->departmentService->delete($id);

        if(!$result){
            return redirect()->back()->with('error', 'Đã xảy ra lỗi!');
        }
        
        return redirect()->route('department.index')->with('success', 'Đã xóa thành công!');
    }
}

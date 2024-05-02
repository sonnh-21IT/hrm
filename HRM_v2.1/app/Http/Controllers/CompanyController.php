<?php

namespace App\Http\Controllers;
use App\Services\CompanyService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    protected $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = $this->companyService->paginate(10);
        return view('pages.companies',['companies'=>$companies]);
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
        $result = $this->companyService->create($request->all());

        if(!$result){
            return redirect()->back()->with('error', 'Đã xảy ra lỗi!');
        }

        return redirect()->route('company.index')->with('success', 'Đã thêm thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $result = $this->companyService->update($id,$request->all());

        if(!$result){
            return redirect()->back()->with('error', 'Đã xảy ra lỗi!');
        }
        
        return redirect()->route('company.index')->with('success', 'Đã cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $result = $this->companyService->delete($id);

        if(!$result){
            return redirect()->back()->with('error', 'Đã xảy ra lỗi!');
        }
        
        return redirect()->route('company.index')->with('success', 'Đã xóa thành công!');
    }
}

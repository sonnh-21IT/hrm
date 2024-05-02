<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CountryService;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CountryRequest;

class CountryController extends Controller
{

    protected $countryService;

    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = $this->countryService->paginate(10);
        return view('pages.countries',['countries'=>$countries]);
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
    public function store(CountryRequest $request)
    {
        $data = $request->validated();

        $result = $this->countryService->create($request->all());

        if(!$result){
            return redirect()->back()->with('error', 'Đã xảy ra lỗi!');
        }

        return redirect()->route('country.index')->with('success', 'Đã thêm thành công!');
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
    public function update(CountryRequest $request, $id)
    {
        $data = $request->validated();

        $result = $this->countryService->update($id,$data);

        if(!$result){
            return redirect()->back()->with('error', 'Đã xảy ra lỗi!');
        }
        return redirect()->route('country.index')->with('success', 'Đã cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $result = $this->countryService->delete($id);

        if(!$result){
            return redirect()->back()->with('error', 'Đã xảy ra lỗi!');
        }
        
        return redirect()->route('country.index')->with('success', 'Đã xóa thành công!');
    }
}

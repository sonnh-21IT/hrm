<?php

namespace App\Http\Controllers;
use App\Services\CustomUserService;
use App\Services\PersonService;
use App\Services\CompanyService;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;

class CustomUserController extends Controller
{

    protected $customUserService;
    protected $personService;
    protected $companyService;
    protected $roleService;

    public function __construct(CustomUserService $customUserService, PersonService $personService, CompanyService $companyService, RoleService $roleService)
    {
        $this->customUserService = $customUserService;
        $this->personService = $personService;
        $this->companyService = $companyService;
        $this->roleService = $roleService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $people = $this->customUserService->paginate(10);
        $companies = $this->companyService->getAll();
        $roles = $this->roleService->getAll();
        return view('pages.people',['people'=>$people,'companies'=>$companies, 'roles'=>$roles]);
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
        //
        $encryptedPassword = Hash::make($request->password);
        $request->merge(['password' => $encryptedPassword]);

        $user = $this->customUserService->create($request->all());

        if(!$user){
            return redirect()->back()->with('error', 'Đã xảy ra lỗi!');
        }

        try{
            $user->roles()->sync($request->input('roles',[]));   
        }catch(QueryException $e){
            Session::flash('error', 'Chức vụ chưa được thêm cho ' . $user->person->full_name);
        }

        $request->merge(['user_id' => $user->id]);

        $result = $this->personService->create($request->all());

        if(!$result){
            $this->customUserService->delete($user->id);
            return redirect()->back()->with('error', 'Đã xảy ra lỗi!');
        }
        
        return redirect()->route('user.index')->with('success', 'Đã thêm thành công!');
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
        $old_user = $this->customUserService->getById($id);
        $user = $this->customUserService->update($id, $request->all());
        
        if (!$user) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi!');
        }

        try{
            $user->roles()->sync($request->input('roles',[]));   
        }catch(QueryException $e){
            Session::flash('error', 'Chức vụ chưa được sửa cho ' + $user->person->full_name);
        }
        
        $request->merge(['user_id' => $id]);
        
        $result = $this->personService->update($old_user->person->id, $request->all());
        
        if (!$result) {
            $this->customUserService->update($old_user->id, $user);
            return redirect()->back()->with('error', 'Đã xảy ra lỗi!');
        }
        
        return redirect()->route('user.index')->with('success', 'Đã cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {        
        $result = $this->customUserService->delete($id);
        
        if(!$result){
            return redirect()->back()->with('error', 'Đã xảy ra lỗi!');
        }

        return redirect()->route('user.index')->with('success', 'Đã xóa thành công!');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Role;
use App\Model\Vendor;
use DataTables;
use App\Services\LanguageService;
use Illuminate\Support\Facades\Hash;
use URL;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return Datatables::of(Vendor::latest()->with('user')->get())
            ->editColumn('status',function($row){
                $checked = "";
                    if ($row->status == 1) {
                        $checked = "checked";
                    }
                    return '<label class="ts-swich-label d-inline">
                                <input data-href="' . URL::to('admin/vendor/status/' . $row->id) . '"  type="checkbox"' . $checked . ' class="switch-status switch ts-swich-input" name="status" id="" value="1">
                                <span class="ts-swich-body"></span>
                            </label>';
            })

            ->rawColumns(['action', 'index', 'status', 'image','selling_price'])
                ->make(true);
      }
        return view('admin.vendor.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=Role::orderBy('name')->get();
        return view('admin.user.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user=User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar'=>$request->avatar,
            'type'=>3
        ]);
       
        if($request->role){
            foreach($request->role as $role){
                $user->assignRole($role);
            }
        }
       return redirect()->route('user.index')->with('success',LanguageService::getTranslate('UserCreatedSuccessfully'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\User  $User
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles=Role::orderBy('name')->get();
        $userRoles=$user->roles->pluck("id")->toArray();
        return view('admin.user.edit',compact('roles','user','userRoles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\User  $User
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
       
        ]);
        $user->update([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'avatar'=>$request->avatar,
            'type'=>3
        ]);
        $roles=$user->roles->pluck("id")->toArray();
        $user->roles()->detach($roles);
        if($request->role){
            foreach($request->role as $role){
                $user->assignRole($role);
            }
        }
       return redirect()->route('user.index')->with('success',LanguageService::getTranslate('UserUpdatedSuccessfully'));
    }

    public function updateStatus(Vendor $vendor, $status)
    {
        $user=User::find($vendor->user_id);
        
        $user->update([
            "is_vendor"=>$status
        ]);
        $vendor->update([
            "status" => $status
        ]);
        return "Vendor Updated Successfully";
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\User  $User
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->avatar){
            unlink(public_path('images/user/'.$user->avatar));
        }
        $user->delete();

        return LanguageService::getTranslate("UserDeletedSuccessfully");
    }
    public function multiDelete( $ids)
    {
        foreach(json_decode($ids) as $id){
            $user=User::find($id);
            if($user->avatar){
                unlink(public_path('images/user/'.$user->avatar));
            }
            $user->delete();
        }
        return LanguageService::getTranslate("UserDeletedSuccessfully");
    }
}

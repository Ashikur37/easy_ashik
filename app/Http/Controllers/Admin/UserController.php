<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Role;
use App\Services\Datatable;
use App\Services\LanguageService;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $table=new Datatable('User','user');
            $data=User::where('id', '!=', 1)->where('type',3)->latest()->get();
            return $table->getAllByData($data);
      }
        return view('admin.user.index');
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

<?php

namespace App\Http\Controllers\Admin;

use App\Model\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use DataTables;
use App\Services\LanguageService;
use Exception;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $user = auth()->user();
            $data = Role::where('id', '!=', 1)->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('index', function ($row) {
                    return '<div class="icheck-primary d-inline">
                            <input data-id="' . $row->id . '" class="check-element check-id"  type="checkbox" id="checkboxPrimary' . $row->id . '" >
                            <label for="checkboxPrimary' . $row->id . '">
                            </label>
                          </div>';
                })
                ->addColumn('action', function ($row) use ($user) {
                    $btn = '';
                    if ($user->can('role.edit')) {
                        $btn .= '<span class="ts-action-btn mr-2">
                                <a href="' . route("role.edit", $row->id) . '"><i class="ri-pencil-line"></i></a>
                            </span> ';
                    }

                    if ($user->can('role.destroy')) {
                        $btn .= '<span class="ts-action-btn">
                            <a class="delete-button" href="#" data-href="' . route("role.destroy", $row->id) . '"><i class="ri-delete-bin-line"></i></a>
                        </span>';
                    }
                    return $btn;
                })
                ->rawColumns(['action', 'index'])
                ->make(true);
        }

        return view('admin.role.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create([
            "name" => $request->name,
            "label" => $request->label
        ]);
        if ($request->permission) {
            foreach ($request->permission as $permission) {
                if (explode(',', $permission) > 1) {
                    foreach (explode(',', $permission) as $perm) {
                        try {
                            $role->permissions()->attach($perm);
                        } catch (Exception $e) {
                        }
                    }
                } else {
                    try {
                        $role->permissions()->attach($permission);
                    } catch (Exception $e) {
                    }
                }
            }
        }
        return redirect()->route('role.index')->with('success', LanguageService::getTranslate('RoleCreatedSuccessfully'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = $role->permissions->pluck("id")->toArray();
        return view('admin.role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        $role->update([
            "name" => $request->name,
            "label" => $request->label
        ]);
        $permissions = $role->permissions->pluck("id")->toArray();
        $role->permissions()->detach($permissions);
        if ($request->permission) {
            foreach ($request->permission as $permission) {
                if (explode(',', $permission) > 1) {
                    foreach (explode(',', $permission) as $perm) {
                        try {
                            $role->permissions()->attach($perm);
                        } catch (Exception $e) {
                        }
                    }
                } else {
                    try {
                        $role->permissions()->attach($permission);
                    } catch (Exception $e) {
                    }
                }
            }
        }
        return back()->with('success', LanguageService::getTranslate('RoleUpdatedSuccessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return LanguageService::getTranslate("RoleDeletedSuccessfully");
    }
    public function multiDelete($ids)
    {
        foreach (json_decode($ids) as $id) {
            $role = Role::find($id);
            $role->delete();
        }
        return LanguageService::getTranslate("RoleDeletedSuccessfully");
    }
}

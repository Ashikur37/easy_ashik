<?php

namespace App\Http\Controllers\Admin;

use App\Model\Page;
use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Services\Datatable;
use App\Services\LanguageService;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route = "page";
        $user = auth()->user();
        if (request()->ajax()) {
            $table = new Datatable('Page', 'page');
            return $table->get()->editColumn('slug', function ($row) {
                return URL::to('/page/' . $row->slug);
            })->addColumn('index', function ($row) {
                return '<div class="icheck-primary d-inline">
                            <input data-id="' . $row->id . '" class="check-element check-id"  type="checkbox" id="checkboxPrimary' . $row->id . '" >
                            <label for="checkboxPrimary' . $row->id . '">
                            </label>
                        </div>';
            })
                ->addColumn('status', function ($row) {
                    $checked = "";
                    if ($row->active == 1) {
                        $checked = "checked";
                    }
                    return '<label class="ts-swich-label d-inline">
                                <input data-href="' . URL::to('admin/page/status/' . $row->id) . '"  type="checkbox"' . $checked . ' class="switch-status switch ts-swich-input" name="status" id="" value="1">
                                <span class="ts-swich-body"></span>
                            </label>';
                })

                ->addColumn('action', function ($row) use ($user, $route) {
                    $btn = '';
                    if ($user->can($route . '.edit')) {
                        $btn .= '<span class="ts-action-btn mr-2">
                                    <a href="' . route($route . ".edit", $row->id) . '"><i class="ri-pencil-line"></i></a>
                                </span> ';
                    }
                    if ($user->can($route . '.destroy')) {
                        $btn .= '<span class="ts-action-btn">
                                    <a class="delete-button" href="#" data-href="' . route($route . ".destroy", $row->id) . '"><i class="ri-delete-bin-line"></i></a>
                                </span>';
                    }
                    return $btn;
                })->rawColumns(['action', 'index', 'status'])
                ->make(true);
        }
        return view('admin.page.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        Page::create([
            "name" => $request->name,
            "slug" => Str::slug($request->slug),
            "body" => $request->body,
            "active" => $request->active ? 1 : 0,
        ]);
        return redirect()->route('page.index')->with('success', LanguageService::getTranslate('PageCreatedSuccessfully'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('admin.page.edit', compact('page'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, Page $page)
    {
        $page->update([
            "name" => $request->name,
            "slug" => Str::slug($request->slug),
            "body" => $request->body,
            "active" => $request->active ? 1 : 0,
        ]);
        return redirect()->route('page.index')->with('success', LanguageService::getTranslate('PageUpdatedSuccessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return LanguageService::getTranslate("PageDeletedSuccessfully");
    }
    public function multiDelete($ids)
    {
        foreach (json_decode($ids) as $id) {
            $page = Page::find($id);
            $page->delete();
        }
        return LanguageService::getTranslate("PageDeletedSuccessfully");
    }
    public function updateStatus(Page $page, $status)
    {
        $page->update([
            "active" => $status
        ]);
        return LanguageService::getTranslate("PageUpdatedSuccessfully");
    }
    public function multiStatus($status, $ids)
    {
        foreach (json_decode($ids) as $id) {
            $page = Page::find($id);
            $page->update([
                "active" => $status
            ]);
        }
        return LanguageService::getTranslate("PageUpdatedSuccessfully");
    }
}

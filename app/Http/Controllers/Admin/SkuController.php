<?php

namespace App\Http\Controllers\Admin;

use App\File;
use App\Folder;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFoldersRequest;
use App\Http\Requests\Admin\UpdateFoldersRequest;
use App\Models\Sku;
use Request;
use Illuminate\Http\Request as NRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class SkuController extends Controller
{
    /**
     * Display a listing of Folder.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('folder_access')) {
            return abort(401);
        }
        if ($filterBy = Request::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('Sku.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('Sku.filter', 'my');
            }
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('folder_delete')) {
                return abort(401);
            }
            $sku = Sku::onlyTrashed()->get();
        } else {
            $sku = Sku::all();
        }

        return view('admin.sku.index', compact('sku'));
    }

    /**
     * Show the form for creating new Folder.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('folder_create')) {
            return abort(401);
        }

        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.sku.create', compact('created_bies'));
    }

    /**
     * Store a newly created Folder in storage.
     *
     * @param  \App\Http\Requests\StoreFoldersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFoldersRequest $request)
    {
        if (! Gate::allows('folder_create')) {
            return abort(401);
        }
        $folder = Sku::create($request->all());



        return redirect()->route('admin.sku.index');
    }


    /**
     * Show the form for editing Folder.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('folder_edit')) {
            return abort(401);
        }

        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $sku = Sku::findOrFail($id);

        return view('admin.sku.edit', compact('sku', 'created_bies'));
    }

    /**
     * Update Folder in storage.
     *
     * @param  \App\Http\Requests\UpdateFoldersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFoldersRequest $request, $id)
    {
        if (! Gate::allows('folder_edit')) {
            return abort(401);
        }
        $sku = Sku::findOrFail($id);
        $sku->update($request->all());



        return redirect()->route('admin.sku.index');
    }


    /**
     * Display Folder.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('folder_view')) {
            return abort(401);
        }

        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');$files = \App\File::where('folder_id', $id)->get();

        $folder = Folder::findOrFail($id);
        $userFilesCount = File::where('created_by_id', Auth::getUser()->id)->count();

        return view('admin.folders.show', compact('folder', 'files', 'userFilesCount'));
    }


    /**
     * Remove Folder from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('folder_delete')) {
            return abort(401);
        }
        $folder = Folder::findOrFail($id);
        $folder->delete();

        return redirect()->route('admin.folders.index');
    }

    /**
     * Delete all selected Folder at once.
     *
     * @param Request $request
     */
    public function massDestroy(NRequest $request)
    {
        if (! Gate::allows('folder_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Folder::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Folder from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('folder_delete')) {
            return abort(401);
        }
        $folder = Folder::onlyTrashed()->findOrFail($id);
        $folder->restore();

        return redirect()->route('admin.folders.index');
    }

    /**
     * Permanently delete Folder from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('folder_delete')) {
            return abort(401);
        }
        $folder = Folder::onlyTrashed()->findOrFail($id);
        $folder->forceDelete();

        return redirect()->route('admin.folders.index');
    }
}

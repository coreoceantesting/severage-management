<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Masters\Documents\StoreDocumentsRequest;
use App\Http\Requests\Admin\Masters\Documents\UpdateDocumentsRequest;
use App\Models\Documents;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;


class DocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = Documents::latest()->get();
        return view('admin.masters.documents')->with(['documents'=> $documents]);
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
    public function store(StoreDocumentsRequest $request)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            Documents::create($input);
            DB::commit();

            return response()->json(['success'=> 'Document Details created successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'creating', 'Document Details');
        }
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
    public function edit(Documents $document)
    {
        if ($document)
        {
            $response = [
                'result' => 1,
                'Documents' => $document,
            ];
        }
        else
        {
            $response = ['result' => 0];
        }
        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDocumentsRequest $request, Documents $document)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $document->update($input);
            DB::commit();

            return response()->json(['success'=> 'Documents updated successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'updating', 'Documents');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Documents $document)
    {
        try
        {
            DB::beginTransaction();
            $document->delete();
            DB::commit();

            return response()->json(['success'=> 'Documents Details deleted successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'deleting', 'Documents');
        }
    }
}

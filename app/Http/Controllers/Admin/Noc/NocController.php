<?php

namespace App\Http\Controllers\Admin\Noc;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Models\PropertyType; 
use App\Models\Documents;
use App\Models\Noc;
use App\Http\Requests\Admin\NOC\StoreNocRequest;
use Illuminate\Support\Facades\DB;

class NocController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $propertyTypes = PropertyType::latest()->get();
        $documents = Documents::latest()->get();
        return view('Noc.create')->with(['propertyTypes' => $propertyTypes, 'documents' => $documents]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
            
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNocRequest $request)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $input['application_id'] = date('Y').'/'.rand(0000,9999);
            $applicantion = Noc::create($input);
            if ($request->hasFile('doc')) {
                foreach ($request->file('doc') as $key => $file) {
                    $filePath = $file->store('documents', 'public');
        
                    DB::table('noc_documents')->insert([
                        'application_id' => $applicantion->id,
                        'file_path' => $filePath,
                    ]);
                }
            }
            DB::commit();

            return response()->json(['success'=> 'NOC created successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'creating', 'NOC');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

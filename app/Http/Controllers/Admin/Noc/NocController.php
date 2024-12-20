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

            $input['application_id'] = date('Y') . '/' . rand(0000, 9999);

            $application = Noc::create($input);

            if ($request->hasFile('doc') && count($request->file('doc')) > 0) {

                foreach ($request->file('doc') as $key => $file) {

                    if ($file) {
                        $filePath = $file->store('documents', 'public');

                        DB::table('noc_documents')->insert([
                            'application_id' => $application->id,
                            'document_id' => $request->input('doc_id')[$key],
                            'file_path' => $filePath,
                        ]);
                    }

                }
                
            }
            DB::commit();
            return response()->json(['success' => 'NOC created successfully!']);
        }
        catch (\Exception $e)
        {

            DB::rollBack();

            return $this->respondWithAjax($e, 'creating', 'NOC');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Noc_data = Noc::findorFail($id);
        $noc_documents = DB::table('noc_documents')->join('documents', 'noc_documents.document_id', '=', 'documents.id')
                        ->where('application_id', $id)
                        ->get();
        $propertyTypes = PropertyType::latest()->get();
        return view('Noc.show')->with(['Noc_data' => $Noc_data, 'noc_documents' => $noc_documents, 'propertyTypes' => $propertyTypes]);
        
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

<?php

namespace App\Http\Controllers\Admin\Noc;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Models\PropertyType;
use App\Models\Documents;
use App\Models\Noc;
use App\Http\Requests\Admin\NOC\StoreNocRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;



class NocController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function downloadNocPDF($id)
     {
         // Fetch the NOC data by ID

         $nocData = Noc::findOrFail($id);

         $propertyTypes = PropertyType::all(); // Fetch property types if needed

         // Load a view and pass the data to it
         $pdf = PDF::loadView('pdf.noc_details', compact('nocData', 'propertyTypes'));

         // Download the PDF
         return $pdf->download('noc_details' . $nocData->application_id . '.pdf');
     }

    public function index()
    {
        // $nocDataList = NocData::all();
        $nocs = Noc::all(); // Adjust this query as needed
        $propertyTypes = PropertyType::latest()->get();
        $documents = Documents::latest()->get();
        return view('Noc.create')->with(['propertyTypes' => $propertyTypes, 'documents' => $documents]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNocRequest $request)
    {

        try {
            DB::beginTransaction();

            // Validate and process input data
            $input = $request->validated();
            $input['application_id'] = date('Y') . '/' . rand(0000, 9999);
            $application = Noc::create($input);

            // Handle document uploads
            $request->validate([
                'file' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:2048',
            ]);
            $file = $request->file('file');
            $filePath = $file->store('documents', 'public');

            DB::table('noc_documents')->insert([
                'application_id' => $application->id,
                // 'document_id' => $request->input('document_id'),
                'file_path' => $filePath,
                'created_at' => now(),
                'updated_at' => now(),
            ]);


            DB::commit();
            return response()->json(['success' => 'NOC created successfully!']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating NOC: ' . $e->getMessage());
            return $this->respondWithAjax($e, 'creating', 'NOC');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $nocData = Noc::join('noc_documents', 'noc_documents.application_id', '=', 'nocs.id')->where('nocs.id', $id)->first();

        $noc_documents = DB::table('nocs')->join('noc_documents', 'noc_documents.application_id', '=', 'nocs.id')->get();

        // dd($noc_documents);
        $propertyTypes = PropertyType::all();
        // $noc = Noc::find($id);
        return view('Noc.show')->with(['nocData' => $nocData, 'noc_documents' => $noc_documents, 'propertyTypes' => $propertyTypes]);
    }

    /**
     * Approve the specified NOC application.
     */
    public function approve(Request $request)
    {


      //  dd($request->all());
        $noc = Noc::find($request->id);
      //  dd($noc);

        // Check if the status is already approved at the current stage
        if ($noc->status === 'approved') {
            return redirect()->back()->with('error', 'This application is already approved.');
        }

      //  dd($request->all());
        if (Auth::user()->hasRole('CLerk')) {
            // $noc->clerk_status = $request->status;
            // $noc->clerk_remark = $request->remark;
            // $noc->save();

            if ($request->status == "1") {
                $noc->clerk_status = $request->status;
                $noc->clerk_remark = $request->remark;
                $noc->save();
                $noc->status = 'jr_eng_pending'; // Move to the next stage
                $message = "Application Approved Successfully";
            } elseif ($request->status == "2") {
                $noc->approval_status= '2';
                $noc->clerk_status = $request->status;
                $noc->clerk_remark = $request->remark;
                $noc->save();

               // Reject the application
                $message = "Application Rejected Successfully";
            }

            return redirect()->back()->with('message', $message);

        } elseif (Auth::user()->hasRole('Junior Engineer')) {
            $noc->jr_eng_status = $request->status;
            $noc->jr_eng_remark = $request->remark;
            $noc->save();

            if ($request->status == "1") {
                $noc->status = 'sr_eng_pending';
                $message = "Application Approved Successfully";
            } else {
                $noc->status = 'rejected';
                $message = "Application Rejected Successfully";
            }

            return redirect()->back()->with('message', $message);

        } elseif (Auth::user()->hasRole('Senior Engineer')) {
            $noc->sr_eng_status = $request->status;
            $noc->sr_eng_remark = $request->remark;
            $noc->save();

            if ($request->status == "1") {
                $noc->status = 'hod_pending';
                $message = "Application Approved Successfully";
            } else {
                $noc->status = 'rejected';
                $message = "Application Rejected Successfully";
            }

            return redirect()->back()->with('message', $message);

        } elseif (Auth::user()->hasRole('HOD')) {
            $noc->hod_status = $request->status;
            $noc->hod_remark = $request->remark;
            $noc->save();

            if ($request->status == "1") {
                $noc->status = 'city_eng_pending';
                $message = "Application Approved Successfully";
            } else {
                $noc->status = 'rejected';
                $message = "Application Rejected Successfully";
            }

            return redirect()->back()->with('message', $message);

        } elseif (Auth::user()->hasRole('Citizen Engineer')) {
            $noc->city_eng_status = $request->status;
            $noc->city_eng_remark = $request->remark;
            $noc->save();

            if ($request->status == "1") {
                $noc->status = 'final_approved'; // Final approval
                dd($noc);
                $message = "Application Approved Successfully. <a href='". route('download.pdf', $noc->id) . "'>Click here to download the approval PDF</a>";
            } else {
                $noc->status = 'rejected';
                $message = "Application Rejected Successfully";
            }

            return redirect()->back()->with('message', $message);
        }
    }




}


    /**
     * Reject the specified NOC application.
     */
    // public function reject($id)
    // {
    //     $noc = Noc::findOrFail($id);
    //     $noc->approval_status = 2; // Set to rejected status
    //     $noc->save();

    //     return redirect()->back()->with('success', 'Application rejected successfully.');
    // }


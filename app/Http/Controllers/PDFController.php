<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF; // Import the PDF facade
use App\Models\Noc;
use App\Models\PropertyType;
use App\Http\Controllers\Noc\NocController;
use App\Models\NocData;
use Illuminate\Support\Facades\DB;

class PDFController extends Controller
{
//     public function downloadApplicationsPDFapplication($id)
// {
//     $nocData = NocData::find($id);

//     if (!$nocData) {
//         return redirect()->route('noc.index')->with('error', 'NOC Data not found!');
//     }

//     $data = ['nocData' => $nocData];

//     $pdf = PDF::loadView('pdf.nocDetails', $data);

//     return $pdf->download('noc_details.pdf');
// }


    public function downloadApplicationsPDF($id)
    {
        // // Fetch the data you want to include in the PDF
        // $nocData = Noc::find($id);
        // $propertyTypes = PropertyType::all();  // Fetch property types if needed

        // // Generate the PDF using the Blade view
        // $pdf = PDF::loadView('pdf.noc_details', compact('nocData', 'propertyTypes'));

        // // Return the PDF as a download
        // return $pdf->download('noc_details_'.$nocData->id.'.pdf');

        $nocData = Noc::join('noc_documents', 'noc_documents.application_id', '=', 'nocs.id')
                  ->where('nocs.id', $id)
                  ->first();

                  $noc_documents = DB::table('nocs')
                   ->join('noc_documents', 'noc_documents.application_id', '=', 'nocs.id')
                   ->select('noc_documents.file_path')  // Select specific columns
                   ->get();

    $propertyTypes = PropertyType::all();

    // Load the PDF view and pass the data
    $pdf = PDF::loadView('pdf.noc', compact('nocData', 'noc_documents', 'propertyTypes'));

    // Download the PDF file
    return $pdf->download('noc_details_' . $nocData->id . '.pdf');
    }

}

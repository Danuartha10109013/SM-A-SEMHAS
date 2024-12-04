<?php

namespace App\Http\Controllers;

use \Mpdf\Mpdf;

use App\Models\Coil;
use App\Models\MapCoil;
use App\Models\MapCoilTruck;
use App\Models\Pengecekan;
use App\Models\Shipment;
// use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\Facade\Pdf;
// use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    // public function view_pdf($id){
    //     $mpdf = new \Mpdf\Mpdf();
    //     $data=Pengecekan::where('no_gs',$id)->get();
    //     $coil=MapCoil::where('no_gs', $id)->get();
    //     $img = Coil::where('no_gs',$id)->pluck('keterangan');
    //     $mpdf->WriteHTML(view('content.pengecekan.print', compact('data','coil', )));
    //     $mpdf->Output('cc.pdf','D');
    // }
    public function view_pdf($id)
    {
        $viewPath = resource_path('views/content/dashboard/coil.blade.php');

if (file_exists($viewPath)) {
    // File exists, proceed with PDF generation
    $data = Pengecekan::where('no_gs', $id)->get();
    $coil = MapCoil::where('no_gs', $id)->get();
    $pdf = PDF::loadView('content.pengecekan.v_print', compact('data', 'coil'));
    $pdf->setPaper('legal', 'portrait');
    return $pdf->stream('cc.pdf');
} else {
    // Log the error or abort with a message
    abort(404, 'View file not found at: ' . $viewPath);
}

        
    }
    
    public function print($id){
        $data=Pengecekan::where('no_gs',$id)->get();
        $coil=MapCoil::where('no_gs', $id)->get();
        $img = Coil::where('no_gs',$id)->pluck('keterangan');
        $ids=Pengecekan::where('no_gs',$id)->value('id');
        $sign = Pengecekan::find($ids);
        
        return view('Mapping-Container.content.pengecekan.print', compact('data','coil','sign','id' ));
    }

public function downloadPDF($id)
{
    $data=Pengecekan::where('no_gs',$id)->get();
    $coil=MapCoil::where('no_gs', $id)->get();
    $img = Coil::where('no_gs',$id)->pluck('keterangan');
    $ids=Pengecekan::where('no_gs',$id)->value('id');
    $sign = Pengecekan::find($ids);

    // Muat view dengan data dan set ukuran kertas
    $pdf = Pdf::loadView('Mapping-Container.content.pengecekan.print', compact('data','coil','sign','id'));

    // Unduh file PDF
    return $pdf->download('Mapping_Muat_Ceklist_Kontainer.pdf');
}

    public function printtruck($id){
        $data=Pengecekan::where('no_gs',$id)->get();
        $coil=MapCoilTruck::where('no_gs', $id)->get();
        $img = Coil::where('no_gs',$id)->pluck('keterangan');
        $ids=Pengecekan::where('no_gs',$id)->value('id');
        $sign = Pengecekan::find($ids);
        
        return view('Mapping-Container.content.pengecekan.printtruck', compact('data','coil','sign' ,'id'));
    }
}

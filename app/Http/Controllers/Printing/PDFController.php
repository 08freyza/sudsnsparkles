<?php

namespace App\Http\Controllers\Printing;

use Mpdf\Mpdf;
use Mpdf\HTMLParserMode;
use Illuminate\Http\Request;
use Mpdf\Output\Destination;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PDFController extends Controller
{
    public function test(Request $request)
    {
        //validate request
        Validator::validate($request->all(), [
            'name' => 'required|string|min:1',
            'content' => 'required|string|min:1'
        ]);

        // create PDF
        $mpdf = new Mpdf();

        $header = trim($request->get('header', ''));
        $footer = trim($request->get('footer', ''));

        if (strlen($header)) {
            $mpdf->SetHTMLHeader($header);
        }

        if (strlen($footer)) {
            $mpdf->SetHTMLFooter($footer);
        }

        if ($request->get('show_toc')) {
            $mpdf->h2toc = array(
                'H1' => 0,
                'H2' => 1,
                'H3' => 2,
                'H4' => 3,
                'H5' => 4,
                'H6' => 5
            );
            $mpdf->TOCpagebreak();
        }

        $stylesheet = "h1 { color: red; }";
        $mpdf->WriteHTML($stylesheet, HTMLParserMode::HEADER_CSS);

        //write content
        $mpdf->WriteHTML($request->get('content'));

        //return the PDF for download
        return $mpdf->Output($request->get('name') . '.pdf', Destination::DOWNLOAD);
    }
}

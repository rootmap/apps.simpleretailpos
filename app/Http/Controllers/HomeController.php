<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function exportExcel(){


        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');

        $writer = new Xlsx($spreadsheet);
        //$writer->save('hello world.xlsx');
        $fileName="demo.xlsx";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
        $writer->save('php://output');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function welcome()
    {
        return view('welcome');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App;
use Auth;
use Illuminate\Http\Request;

/*
    note: install laravel pdf library
    https://github.com/barryvdh/laravel-dompdf
*/

class ReportController extends Controller
{
    public function report1($pid) {
        $payment = Payment::find($pid);
        $pdf = App::make('dompdf.wrapper');
        $print = "<div style='margin:20px; padding:20px;'>";
        $print.= "<h1 style='text-align:center;'>Payment Receipt</h1>";
        $print.= "</hr>";

        $print.= "<p>Receipt No: <b>" . $pid ."</b></p>";
        $print.= "<p>Payment Date: <b>". $payment->payment_date ."</b></p>";
        $print.= "<p>Enrollment No: <b>". $payment->enrollment->enroll_no ."</b></p>";
        $print.= "<p>Student Name: <b>". $payment->enrollment->student->name ."</b></p>";
        $print.= "</hr>";

        $print.= "<table style='margin-left: auto; margin-right: auto; border-collapse: collapse;'>";
        $print.= "<tr>";
        $print.= "<th colspan='2' style='border: 1px solid #dddddd; margin: 2px; padding: 2px;'><b>Enrollment Details</b></th>";
        $print.= "</tr>";

        $print.= "<tr>";
        $print.= "<td style='border: 1px solid #dddddd; margin: 2px; padding: 2px;'>Batch:</td>";
        $print.= "<td style='border: 1px solid #dddddd; margin: 2px; padding: 2px;'><h3>". $payment-> enrollment-> batch->name ."</h3></td>";
        $print.= "</tr>";

        $print.= "<tr>";
        $print.= "<td style='border: 1px solid #dddddd; margin: 2px; padding: 2px;'>Amount:</td>";
        $print.= "<td style='border: 1px solid #dddddd; margin: 2px; padding: 2px;'><h3> PHP ". number_format($payment->amount, 2, '.', ',') ."</h3></td>";
        $print.= "</tr>";

        $print.= "</table>";
        $print.= "</hr>";

        $authenticatedUser = Auth::user();
        $printedByName = $authenticatedUser ? $authenticatedUser->name : 'Unknown';

        $print.= "</br></br></br>";

        $print.= "Printed by: <b>". $printedByName ."</b></br>";
        $print.= "Printed date: <b>". date('Y-m-d') ."</b>";
        
        $print.= "</div>";

        $pdf->loadHTML($print);
        return $pdf->stream();
    }
}

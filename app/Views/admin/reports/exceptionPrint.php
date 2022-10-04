<?php
//============================================================+
// File name   : example_003.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 003 for TCPDF class
//               Custom Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Custom Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once(APPPATH.'libraries\tcpdf\tcpdf.php');


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'imgicon.jpg';
        $this->Image($image_file, 60, 10, 30, 30, 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Position at 15 mm from bottom
        $this->SetY(15);
         $this->SetX(100);
        // Set font
        $this->SetFont('helvetica', 'B', 12);
        // Title
        $this->Cell(0, 0, 'Maylaflor AirConditioning and Refrigeration Services, Inc.', 0, false, 'L', 0, '', 0, false, 'T', 'B');
    }

    // Page footer
    public function Footer() {
        $this->SetXY(220,190);
        $this->SetFont('helvetica','', 10);
        $userp= $_SESSION['username'];
        $this->Cell(0, 10, 'Prepared By: '.$userp, 0, false, 'L', 0, '', 0, false, 'T', 'M');
    	//date
    	 $this->SetXY(17,62);
        $this->SetFont('helvetica','', 10);
        // Setting Date ( I have set the date here )
        $tDate=date('F d, Y');
        $this->Cell(0, 10, 'Date Printed: '.$tDate, 0, false, 'L', 0, '', 0, false, 'T', 'M');
        // Page
        $this->SetY(1);
         $this->SetX(280);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Maylaflor AirConditioning and Refrigeration Services, Inc.');
$pdf->SetTitle('Detailed Exception Report');
$pdf->SetSubject('Detailed Exception Report');


// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------


// set font
$pdf->SetFont('times', '', 11);

// add a page
$pdf->AddPage('L');

// set some text to print
$txt = <<<EOD
2958 A. Dominguez St., Malibay, Pasay City, 1300
                              Telefax #:  700-22352 / 0908-8919850 / 0923-0826305  
                              Email Add:  maylaflorairconditioningref27@gmail.com
EOD;
$pdf->SetXY(40, 23);
// print a block of text using Write()
$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);




$html = '<span style="text-align: center;"><b>Detailed Exception Report</b><br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;From '. date('F j, Y',strtotime($date[0])).' to '. date('F j, Y',strtotime($date[1])). '</span><br><br><br><br>';
$pdf->SetXY(25, 45);
$pdf->SetFont('helvetica', '', 11);
if($event){
$html .= '<table cellspacing="0" cellpadding="10" border="1" id="table1">
				       <thead>
				          <tr style = "background-color: #A8D08D; text-align: center; font-size:10px; white-space:no-wrap;">
				             <th>Date</th>
                             <th>Branch Area</th>
                             <th>Branch Name</th>
                             <th>Service/<br>Task</th> 
                             <th>Service<br>Type</th> 
                             <th>Device Brand/Type</th> 
                             <th>Aircon Type</th> 
                             <th>FCU No.</th>
                             <th>Qty</th> 
                             <th>Assigned Person</th>
                             <th>Service/<br>Task Price</th>
                             <th>Total Service/<br>Task Price</th>
                             <th>Status</th>
				          </tr>
				       </thead>
				       <tbody>';
     
        // dd($all_events);
     foreach($event as $dat){
				   
				   $html .='     <tr style="font-size:9px; text-align: center;">
				             <td>'.date('m-d-Y',strtotime($dat->start_event)).'</td>
                             <td>'.$dat->area.'</td>
                             <td>'.$dat->client_branch.'</td>
                             <td>'.$dat->serv_name.'</td>
                             <td>'.$dat->serv_type.'</td>
                             <td>'.$dat->device_brand.'</td>
                             <td>'.$dat->aircon_type.'</td><td>';
                    $data1 = explode(',',$dat->fcu_array);
                    $count1 = 0;
                
                    foreach($data1 as $fc){
                     if($count1 < (count($data1) - 1) ){ 
                       $html .=' '. $fc.'<br>';
                        }
                         $count1+=1;
                    }
                    $html .='</td>
                             <td>'.$dat->quantity.'</td><td>';

                    $data = explode(',',$dat->emp_array);
                    $count = 0;
                
                    foreach($data as $emp){
                     if($count < (count($data) - 1) ){ 
                       $html .=' '. $emp.'<br>';
                        }
                         $count+=1;
                    }
                    $html .='</td>';
				     $html .='<td>'.$dat->price.'</td>
                              <td>'.$dat->price*$dat->quantity.'</td>
                            <td style="color:#6C86B4;">'.$dat->status.'</td>
				          </tr>';
				         
				        }

				        
$html .='</tbody>
		</table>';
    }else{
        $html .='<h1 style="text-align:center;">No Data Available!</h1>';
    }

$pdf->writeHTML($html, true, 0, true, true);
// ---------------------------------------------------------

//Close and output PDF document

$pdf->Output('Exception_Report_'.$date[0].'_to_'.$date[1].'.pdf', 'D');

//============================================================+
// END OF FILE
//============================================================+
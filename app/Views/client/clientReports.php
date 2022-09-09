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
    	 $this->SetXY(17,55);
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
$pdf->SetTitle('Client List');
$pdf->SetSubject('Client List');


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




$html = '<span style="text-align: center;"><b>Client List</b></span><br><br><br><br>';
$pdf->SetXY(25, 45);
$pdf->SetFont('helvetica', '', 11);
$html .= '<table cellspacing="0" cellpadding="10" border="1" id="table1">
				       <thead>
				          <tr style = "background-color: #A8D08D; text-align: center; font-size:10px; white-space:no-wrap;">
				             <th>Client Area</th>
                             <th>Client Branch</th>
                             <th>Address</th>
                             <th>Contact</th>
				          </tr>
				       </thead>
				       <tbody>';
     if($clients)
        // dd($all_events);
     foreach($clients as $cl){
				   
				   $html .='     <tr style="font-size:9px; text-align: center;">
				             
                             <td>'.$cl->area.'</td>
                             <td>'.$cl->client_branch.'</td>
                             <td>'.$cl->client_address.'</td>
                             <td>'.$cl->client_contact.'</td>
                             </tr>';
				         
				        }

				        
$html .='</tbody>
		</table>';

$pdf->writeHTML($html, true, 0, true, true);
// ---------------------------------------------------------

//Close and output PDF document

$pdf->Output('ClientList.pdf', 'D');

//============================================================+
// END OF FILE
//============================================================+
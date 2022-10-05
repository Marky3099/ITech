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
        $monday = strtotime('last monday', strtotime('tomorrow'));
        $sunday = strtotime('+6 days', $monday);
        $this->Image($image_file, 60, 10, 30, 30, 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Position at 15 mm from bottom
        $this->SetY(15);
         // $this->SetX(100);
        // Set font
        $this->SetFont('helvetica', 'B', 12);
        // Title
        $this->Cell(0, 0, 'Maylaflor Air-Conditioning and Refrigeration Services, Inc.', 0, false, 'C', 0, '', 0, false, 'T', 'B');
        //width //height //txt'' //border //ln //align'' //fill //link //stretch //ignore_min_height'' //calign //valign

        //subheader Address
        $this->SetY(25);
        $this->SetFont('helvetica', '', 11);
        $this->Cell(0, 0, ' A. Dominguez  St., Malibay,  Pasay City, 1300 2958', 0, false, 'C', 0, '', 0, false, 'T', 'B');
        // Address cont..
        $this->SetY(30);
        $this->SetFont('helvetica', '', 11);
        $this->Cell(0, 0, 'Telefax #:  8851-1005 / 8425-9958 /  8697-4066  / 8806-4790 ', 0, false, 'C', 0, '', 0, false, 'T', 'B');
        // Address cont..
        $this->SetY(35);
        $this->SetFont('helvetica', '', 11);
        $this->Cell(0, 0, 'Email Add:  maylaflorairconditioningref27@gmail.com', 0, false, 'C', 0, '', 0, false, 'T', 'B');

        //Title 
        $this->SetY(45);
        $this->SetFont('helvetica', 'B', 11);
        $html = 'Employee List';
        $this->Cell(0, 0,$html , 0, false, 'C', 0, '', 0, false, 'T', 'B'); 

        //Date Printed
         // $this->SetXY(17,62);
        $this->SetY(65);
        $this->SetFont('helvetica','', 10);
        // Setting Date ( I have set the date here )
        $tDate=date('F d, Y');
        $this->Cell(0, 0, 'Date Printed: '.$tDate, 0, false, 'L', 0, '', 0, false, 'T', 'M');               
                            
    }

    // Page footer
    public function Footer() {
        $this->SetXY(220,190);
        $this->SetFont('helvetica','', 10);
        $userp= $_SESSION['username'];
        $this->Cell(0, 10, 'Prepared By: '.$userp, 0, false, 'L', 0, '', 0, false, 'T', 'M');
        
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
$pdf->SetAuthor('Maylaflor Air-Conditioning and Refrigeration Services, Inc.');
$pdf->SetTitle('Employee List');
$pdf->SetSubject('Employee List');


// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
// $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetMargins(15, 77, 10, 10);
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
// $pdf->SetFont('times', '', 11);

// add a page
$pdf->AddPage('L');

$pdf->SetXY(15, 70);
$pdf->SetFont('helvetica', '', 11);
if($employee){
$html = '<table cellspacing="0" cellpadding="10" border="1" id="table1">
               <thead>
                  <tr style = "background-color: #A8D08D; text-align: center; font-size:10px; white-space:no-wrap;">
                     <th>Employee Name</th>
                             <th>Email</th>
                             <th>Address</th>
                             <th>Contact</th>
                             <th>Position</th>
                             
                  </tr>
               </thead>
               <tbody>';
   
        // dd($all_events);
     foreach($employee as $em){
           
           $html .='     <tr style="font-size:9px; text-align: center;">
                     
                             <td>'.$em->emp_name.'</td>
                             <td>'.$em->emp_email.'</td>
                             <td>'.$em->emp_address.'</td>
                             <td>'.$em->emp_contact.'</td>
                             <td>'.$em->emp_position.'</td>

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
$pdf->Output('Employee_List.pdf', 'I');
 exit();
//============================================================+
// END OF FILE
//============================================================+
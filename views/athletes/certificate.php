<?php

require_once('./vendor/tecnickcom/tcpdf/tcpdf.php');
// echo ($data['firstName']); exit;
// echo '<img src='' . DIR . 'static/img/certificate/certificate_background.png' width='100%' alt='nix'>'; exit;
// static\img\certificate\certificate_background . png
// vendor\tecnickcom\tcpdf\tcpdf . php
// C:\xampp\htdocs\einzelzeitfahren\vendor\tecnickcom\tcpdf\tcpdf.php

//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
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
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
// require_once('tcpdf_include.php');

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF
{
    //Page header
    public function Header()
    {
        // get the current page break margin
        $bMargin = $this->getBreakMargin();
        // get current auto-page-break mode
        $auto_page_break = $this->AutoPageBreak;
        // disable auto-page-break
        $this->setAutoPageBreak(false, 0);
        // set bacground image
        $img_file = K_PATH_IMAGES . 'certificate/certificate_background.png';
        $this->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
        // restore auto-page-break status
        $this->setAutoPageBreak($auto_page_break, $bMargin);
        // set the starting point for the page content
        $this->setPageMark();
    }

    

    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->setY(-15);
        // Set font
        $this->setFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('TSG Eppstein CL');
$pdf->setTitle('Urkunde 1nzelzeitfahren');
$pdf->setSubject('1nzelzetfahren');
$pdf->setKeywords('');

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(0);
$pdf->setFooterMargin(0);

// remove default footer
$pdf->setPrintFooter(false);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->setFont('times', '', 28);

// add a page
$pdf->AddPage();

// Print a text
$html = '
<head>
<style>
.tsge-red {
    color: #DE002E;
}
.text-center {
    text-align:center;
}
</style>
</head>
<body>
    <div class="text-center">
    
        <h1 class="tsge-red">am ' . $data["date"] . '</h1>
     
        <p><b><font size="+20">Urkunde</font></b></p>
        
        
        <p><b>' . $data["firstName"] . " " . $data["lastName"] . '</b>';

        if($data['teamCompetition'] != 1) {
            $html .= '<small> ' . $data["team"] . '</small></p>';
        };

$html .= '<p> hat ';
        if ($data['teamCompetition'] == 1) {
            $html .= 'bei der ' . $data["team"] . ' Vereinswertung </p>';
        }; 
$html .= '<p>in <b><u>' . $data["time"] . '</u></b> den<br /><b><u>'
            . $data["rank"] . '. Platz</u></b><small> (' . $data["gender"] . ')</small><br />
            belegt.
        </p>              
            <b>Herzliche Glückwünsche zu<br />Deiner Leistung.</b>
        </p>
    </div>
</body>';

$pdf->writeHTML($html, true, false, true, false, '');


// --- example with background set on page ---

// remove default header
$pdf->setPrintHeader(false);



// -- set new background ---

// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->setAutoPageBreak(false, 0);
// set bacground image
$img_file = K_PATH_IMAGES . 'image_demo.jpg';
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
// restore auto-page-break status
$pdf->setAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content
$pdf->setPageMark();


// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('Urkunde-' . $data['firstName'] . '.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
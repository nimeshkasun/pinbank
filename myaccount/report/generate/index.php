<?php
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

	//Page header
	public function Header() {
		// Logo
		$image_file = K_PATH_IMAGES.'pin.jpg';
		$this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Set font
		$this->SetFont('helvetica', 'B', 20);
		// Title
		$this->Cell(0, 15, 'Pin Online Banking', 0, false, 'C', 0, '', 0, false, 'M', 'M');
	}

	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
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
$pdf->SetAuthor('Pin Bank');
$pdf->SetTitle('Pin Account Statement');
$pdf->SetSubject('Pin Account Statement');
$pdf->SetKeywords('Pin, PDF, account, statement, transaction');

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
$pdf->SetFont('times', false, 12);

// add a page
$pdf->AddPage();

session_start();
$accountNumber = $_SESSION['accountNumber'];
$email = $_SESSION['emailsaved'];
$firstnamesaved = $_SESSION['firstnamesaved'];
$lastnamesaved = $_SESSION['lastnamesaved'];
$timeStamp = date("Y-m-d H:i:s");

// ---------------------------------------------------------

$tbl = "
<table>
<tr>
<td style='width:20%;'>Account No</td>
<td>: {$accountNumber}</td>
</tr>
<tr>
<td>Registered Email</td>
<td>: {$email}</td>
</tr>
<tr>
<td>Account Holder</td>
<td>: {$firstnamesaved} {$lastnamesaved}</td>
</tr>
<tr>
<td>Generated Date</td>
<td>: {$timeStamp}</td>
</tr>
</table>
";

$pdf->writeHTML($tbl, false, false, false, false, '');

$tbl1 = "
<br><br>
<table>
	<thead>
		<tr bgcolor='#f5ff9e'>
		<th><b>Transaction Type</b></th>
		<th><b>Date</b></th>
		<th><b>Account</b></th>
		<th><b>Amount</b></th>
		<th><b>Balance</b></th>
		</tr>
	</thead>
	<tbody>
	<tr>
	<td colspan='5'></td>
	</tr>
";

require_once '../../../db_class/dbConn.php';
$accountNumber = $_SESSION["accountNumber"];
$result = $conn->query("SELECT tType, tDate, tDescription, tAccountType, tAmount, tBalance FROM tbltransactions WHERE tAccountNumber='$accountNumber' ORDER BY tDate DESC LIMIT 0,100");
$tbl2 = "";
$count = 0;
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$description = strip_tags($row['tDescription']);

		if($count%2 == 0){
			$tbl2_temp = "
			<tr bgcolor='#d4dcff'>
			<td><font size='10'>{$row['tType']}</font></td>
			<td><font size='10'>{$row['tDate']}</font></td>
			<td><font size='10'>{$row['tAccountType']}</font></td>
			<td><font size='10'>{$row['tAmount']}</font></td>
			<td><font size='10'>{$row['tBalance']}</font></td>
			</tr>
			<tr bgcolor='#d4dcff'>
			<td colspan='5'><font size='8'>{$description}</font></td>
			</tr>
			";
		}else{
			$tbl2_temp = "
			<tr>
			<td><font size='10'>{$row['tType']}</font></td>
			<td><font size='10'>{$row['tDate']}</font></td>
			<td><font size='10'>{$row['tAccountType']}</font></td>
			<td><font size='10'>{$row['tAmount']}</font></td>
			<td><font size='10'>{$row['tBalance']}</font></td>
			</tr>
			<tr>
			<td colspan='5'><font size='8'>{$description}</font></td>
			</tr>
			";
		}
		
		$count++;
		$tbl2 = $tbl2.$tbl2_temp;
	}
}

$tbl3 = "
	</tbody>
</table>
";

$tbl = $tbl1.$tbl2.$tbl3;

$pdf->writeHTML($tbl, false, false, false, false, '');

$pdf->Output('Pin_'.$accountNumber.'_'.$timeStamp.'.pdf', 'I');	

?>




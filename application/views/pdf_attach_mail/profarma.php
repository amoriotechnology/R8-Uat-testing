<?php                

include_once('tcpdf_6_2_13/tcpdf.php'); 

         
  
if(1==1) 
{


	//----- Code for generate pdf
	$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$pdf->SetCreator(PDF_CREATOR);  
	//$pdf->SetTitle("Export HTML Table data to PDF using TCPDF in PHP");  
	$pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
	$pdf->SetDefaultMonospacedFont('helvetica');  
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
	$pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
	$pdf->setPrintHeader(false);  
	$pdf->setPrintFooter(false);  
	$pdf->SetAutoPageBreak(TRUE, 10);  
	$pdf->SetFont('helvetica', '', 12);  
	$pdf->AddPage(); //default A4
	//$pdf->AddPage('P','A5'); //when you require custome page size 
	
	$content = ''; 

	
		
	$content .= '<!DOCTYPE html>
<html>
  <head>
    <style>
      body {
        border: 1px solid #dee2e6;
      }
      table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
      }

      td,
      th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
      }
      .table_view {
        border: 1px solid #111;
        background-color: #5961b3;
      }

      .header_view {
        background-color: #5961b3;
        padding: 10px 40px;
      }
    </style>
  </head>
  <body>
    <table>
      <tr class="header_view">
        <th style="border: none">
          <img src="../../assets/'.$company_info[0]['logo'].'" width="100px" />
          <br />
          <h4 style="color: #fff">'.$company_info[0]['company_name'].'</h4>
        </th>
        <th style="border: none; text-align: right; color: white">'.$company_info[0]['address'].'</th>
      </tr>
    </table>
    <br />

    <table>
      <tr>
        <th style="border: none">Date :'.$invoice[0]['purchase_date'].'</th>
        <th style="border: none">Buyer / Customer:</th>
      </tr>

      <tr>
        <th style="border: none">Invoive No :'.$invoice[0]['purchase_id'].'</th>
        <th style="border: none">Place og Receipt:</th>
      </tr>

      <tr>
        <th style="border: none">Pre Carriage By :'.$invoice[0]['pre_carriage'].'</th>
        <th style="border: none">Country of Final Destination:</th>
      </tr>

      <tr>
        <th style="border: none">Port of Loading :</th>
        <th style="border: none">Port of Discharge :</th>
      </tr>

      <tr>
        <th style="border: none">Terms of Payment & Delivery :</th>
        <th style="border: none">Description of Goods :</th>
      </tr>
    </table>

    <br /><br />
    <table>
      <tr class="table_view">
        <th>Product Name</th>
        <th>In stock</th>
        <th>Quantity / Sq ft.</th>
        <th>Amount</th>
        <th>Total</th>
      </tr>
      <tr>
        <td>Alfreds Futterkiste</td>
        <td>Maria Anders</td>
        <td>Germany</td>
        <td>Germany</td>
        <td>2000</td>
      </tr>
      <tr>
        <td colspan="4" style="text-align: right">Total:</td>
        <td>2000</td>
      </tr>
      <tr>
        <td colspan="4" style="text-align: right">Grand Total:</td>
        <td>2000</td>
      </tr>
    </table>
  </body>
</html>
'; 
 $content;
// echo $content;
// die();
$pdf->writeHTML($content);

$file_location = ""; //add your full path of your server
//$file_location = "/opt/lampp/htdocs/examples/generate_pdf/uploads/"; //for local xampp server

$datetime=date('dmY_hms');
$file_name = $invoiceid."_".$datetime.".pdf";
ob_end_clean();


 if(1==1)
{

$pdf->Output($file_location.$file_name, 'F',777); // F means upload PDF file on some folder

include 'mail.php';
}
else 
{
$pdf->Output($file_location.$file_name, 'F'); // F means upload PDF file on some folder
//echo "Email send successfully!!";
	error_reporting(E_ALL ^ E_DEPRECATED);	
	include_once('PHPMailer/class.phpmailer.php');	
	require ('PHPMailer/PHPMailerAutoload.php');

	$body='';
	$body .="<html>
	<head>
	<style type='text/css'> 
	body {
	font-family: Calibri;
	font-size:16px;
	color:#000;
	}
	</style>
	</head>
	<body>
	Dear Customer,
	<br>
	Please find attached invoice copy.
	<br>
	Thank you!
	</body>
	</html>";

	$mail = new PHPMailer();
	$mail->CharSet = 'UTF-8';
	$mail->IsMAIL();
	$mail->IsSMTP();
	$mail->Subject    = "Invoice details";
	$mail->From = "mail@shinerweb.com";
	$mail->FromName = "Shinerweb Technologies";
	$mail->IsHTML(true);
	$mail->AddAddress('rammg1985@gmail.com'); // To mail id
	//$mail->AddCC('info.shinerweb@gmail.com'); // Cc mail id
	//$mail->AddBCC('info.shinerweb@gmail.com'); // Bcc mail id

	$mail->AddAttachment($file_location.$file_name);
	$mail->MsgHTML ($body);
	$mail->WordWrap = 50;
	$mail->Send();	
	$mail->SmtpClose();
	if($mail->IsError()) {
	echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		echo "Message sent!";	
						
	};
}
//----- End Code for generate pdf
	
}
else
{
	echo 'Record not found for PDF.';
}

?>
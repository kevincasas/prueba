<?php  
session_start();
$count = "";
$t = $_POST['tipo'];

if(isset($_POST["create_pdf"]))  
{
  require_once('tcpdf/tcpdf.php');  
  $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
  $obj_pdf->SetCreator(PDF_CREATOR);  
  $obj_pdf->SetTitle("Examen ".$t);  
  $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
  $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
  $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
  $obj_pdf->SetDefaultMonospacedFont('helvetica');  
  $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
  $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
  $obj_pdf->setPrintHeader(false);  
  $obj_pdf->setPrintFooter(false);  
  $obj_pdf->SetAutoPageBreak(TRUE, 10);  
  $obj_pdf->SetFont('helvetica', '', 12);  
  $obj_pdf->AddPage();  
  $content = '';  
  $content .= '
  <h3 align="center">Examen de Poligrafía</h3><br /><br />  
  <table border="1" cellspacing="0" cellpadding="5"> 
  ';  
  $content .= fetch_data();  
  $content .= '</table>';  
  $obj_pdf->writeHTML($content);  
  $obj_pdf->Output($t. '.pdf', 'I');  
} 

function fetch_data()  
{
  $idpersona = $_POST['idpersona'];
  $tipo = $_POST['tipo'];
  $output = '';  
  $server = 'TPCV359-85.teleperformance.co\SQL2016STD,5081';
  $database = 'HR_Analytics';
  $user = 'Aplicaciones';
  $pass = 'Aplicaciones2019';

  if ($tipo == "Preliminar"){
    
$connect = odbc_connect("Driver={SQL Server ".$_SESSION['nat']."};Server=".$_SESSION['server'].";Database=".$_SESSION['database'].";", $_SESSION['user'], $_SESSION['pass']);

    $sql = "SELECT fechacreacion, ciudadexamen, tipoexamen, motivoexamen, estadoexamen, t_identificacion, no_id, nombre, areaaspira, cargoaspira, diagnostico, rq, color, estadocolor, admisiones, notasft, solicitador, cargosolicitador, poligrafista, nombreExamen  FROM datos_generales_poli  WHERE no_id = ".$idpersona.";";  
    $result = odbc_exec($connect, $sql);  
    $nombreExamen = odbc_result(odbc_exec($connect, $sql), 'nombreExamen');
    $_SESSION['nombreExamen'] = $nombreExamen;
    while($row = odbc_fetch_array($result))  
    {       
      $output .= '

      <tr>
      <th colspan="2"><p align="center">EXAMEN DE POLIGRAFÍA</p></th>
      </tr>
      <tr>  
      <th width="55%">FECHA EN QUE SE REALIZA EL EXAMEN</th>
      <th width="45%">'.$row["fechacreacion"].'</th> 
      </tr>  
      <tr>  
      <th width="55%">CIUDAD EN QUE SE REALIZA</th>  
      <th width="45%">'.utf8_encode($row["ciudadexamen"]).'</th> 
      </tr> 
      <tr>  
      <th width="55%">TIPO DE EXAMEN</th>  
      <th width="45%">'.$row["tipoexamen"].'</th> 
      </tr> 
      <tr>  
      <th width="55%">MOTIVO DE EXAMEN</th>  
      <th width="45%">'.$row["motivoexamen"].'</th> 
      </tr> 
      <tr>  
      <th width="55%">ESTADO DE EXAMEN</th>  
      <th width="45%">'.$row["estadoexamen"].'</th> 
      </tr> 
      <tr>  
      <th width="55%">TIPO DE IDENTIFICACIÓN DE LA PERSONA EVALUADA</th>  
      <th width="45%">'.$row["t_identificacion"].'</th> 
      </tr> 
      <tr>  
      <th width="55%">No. IDENTIFICACIÓN</th>  
      <th width="45%">'.$row["no_id"].'</th> 
      </tr> 
      <tr>  
      <th width="55%">NOMBRE DEL EVALUADO</th>  
      <th width="45%">'.utf8_encode($row["nombre"]).'</th> 
      </tr> 
      <tr>  
      <th width="55%">CAMPAÑA O AREA A LA QUE ASPIRA</th>  
      <th width="45%">'.utf8_encode($row["areaaspira"]).'</th> 
      </tr> 
      <tr>  
      <th width="55%">CARGO AL QUE ASPIRA</th>  
      <th width="45%">'.utf8_encode($row["cargoaspira"]).'</th> 
      </tr>
      <tr>  
      <th width="55%">DIAGNOSTICO</th>  
      <th width="45%">'.$row["diagnostico"].'</th> 
      </tr>
      <tr>  
      <th width="55%">RQ</th>  
      <th width="45%">'.utf8_encode($row["rq"]).'</th> 
      </tr> 
      <tr>  
      <th width="55%">NOTAS FASE DEL TEST</th>  
      <th width="45%">'.utf8_encode($row["notasft"]).'</th> 
      </tr> 
      <tr>  
      <th width="55%">CONCEPTO</th>  
      <th width="45%">'.$row["color"].' '.$row["estadocolor"].'</th> 
      </tr> 
      <tr>  
      <th width="55%">ADMISIONES</th>  
      <th width="45%">'.utf8_encode($row["admisiones"]).'</th> 
      </tr> 
      <tr>  
      <th width="55%">ADMISIONES POST TEST</th>  
      <th width="45%">'.utf8_encode($row["notasft"]).'</th> 
      </tr> 
      <tr>  
      <th width="55%">PERSONA QUE SOLICITA EL EXAMEN</th>  
      <th width="45%">'.utf8_encode($row["solicitador"]).'</th> 
      </tr> 
      <tr>  
      <th width="55%">CARGO DE LA PERSONA QUE SOLICITA</th>  
      <th width="45%">'.utf8_encode($row["cargosolicitador"]).'</th> 
      </tr> 
      <tr> 
      <th width="55%">POLIGRAFISTA</th>  
      <th width="45%">'.$row["poligrafista"].'</th> 
      </tr>  
      ';  
    }  
    return $output;  

} else {
 $connect = odbc_connect("Driver={SQL Server ".$_SESSION['nat']."};Server=".$_SESSION['server'].";Database=".$_SESSION['database'].";", $_SESSION['user'], $_SESSION['pass']);

 $sql = "SELECT fechacreacion, ciudadexamen, tipoexamen, motivoexamen, t_identificacion, no_id, nombre, areaaspira, cargoaspira, color, notasft, solicitador, cargosolicitador, poligrafista  FROM datos_generales_poli  WHERE no_id = ".$idpersona.";"; 
 $result = odbc_exec($connect, $sql);  
 while($row = odbc_fetch_array($result))  
 {       
  $output .= '

  <tr>
  <th colspan="2"><p align="center">Examen '.$row["tipoexamen"].'</p></th>
  </tr>
  <tr>  
  <th width="55%">FECHA EN QUE SE REALIZA EL EXAMEN</th>
  <th width="45%">'.$row["fechacreacion"].'</th> 
  </tr>  
  <tr>  
  <th width="55%">CIUDAD EN QUE SE REALIZA</th>  
  <th width="45%">'.utf8_encode($row["ciudadexamen"]).'</th> 
  </tr> 
  <tr>  
  <th width="55%">TIPO DE EXAMEN</th>  
  <th width="45%">'.$row["tipoexamen"].'</th> 
  </tr> 
  <tr>  
  <th width="55%">MOTIVO DE EXAMEN</th>  
  <th width="45%">'.$row["motivoexamen"].'</th> 
  </tr> 
  <tr>  
  <th width="55%">TIPO DE IDENTIFICACIÓN DE LA PERSONA EVALUADA</th>  
  <th width="45%">'.$row["t_identificacion"].'</th> 
  </tr> 
  <tr>  
  <th width="55%">No. IDENTIFICACIÓN</th>  
  <th width="45%">'.$row["no_id"].'</th> 
  </tr> 
  <tr>  
  <th width="55%">NOMBRE DEL EVALUADO</th>  
  <th width="45%">'.$row["nombre"].'</th> 
  </tr> 
  <tr>  
  <th width="55%">CAMPAÑA O AREA A LA QUE ASPIRA</th>  
  <th width="45%">'.$row["areaaspira"].'</th> 
  </tr> 
  <tr>  
  <th width="55%">CARGO AL QUE ASPIRA</th>  
  <th width="45%">'.$row["cargoaspira"].'</th> 
  </tr> 
  <tr>  
  <th width="55%">CONCEPTO</th>  
  <th width="45%">'.$row["color"].'</th> 
  </tr> 
  <tr>  
  <th width="55%">NOTAS</th>  
  <th width="45%">'.$row["notasft"].'</th> 
  </tr> 
  <tr>  
  <th width="55%">PERSONA QUE SOLICITA EL EXAMEN</th>  
  <th width="45%">'.utf8_encode($row["solicitador"]).'</th> 
  </tr> 
  <tr>  
  <th width="55%">CARGO DE LA PERSONA QUE SOLICITA</th>  
  <th width="45%">'.utf8_encode($row["cargosolicitador"]).'</th> 
  </tr> 
  <tr> 
  <th width="55%">POLIGRAFISTA</th>  
  <th width="45%">'.$row["poligrafista"].'</th> 
  </tr>    
  ';  
}  
return $output;  
}
}
?> 

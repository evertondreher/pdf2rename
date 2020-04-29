<?php
include('PdfToText/PdfToText.php');

if  ( php_sapi_name ( )  !=  'cli' )
		echo ( "<pre>" ) ;

$diretorio = "files/";
/*







$pdfFile = 'files/declaracao.pdf';

$pdf = new PdfToText($pdfFile, PdfToText::PDFOPT_DEBUG_SHOW_COORDINATES);
file_put_contents('sample-report.txt', $pdf -> Text);
$string = "Toledo";
$data = $pdf->Text;

if (strpos($data, $string) !== false) {
    echo $string;
} else {
    echo "<br>Falha ao encontrar a palavra " . $string;
}
*/

$files = glob($diretorio . '*.pdf');

//Conta quantos arquivos existem na pasta
/*if ($files !== false) {
	$filecount = count($files);
	echo $filecount;
}*/

$nomesArquivos = array_values(array_diff(scandir($diretorio), array('.', '..'))); //Cria um array com os nomes dos arquivos

foreach ($nomesArquivos as $key => $value) {

	$pdf_file = $diretorio . $value;
	$xml_file = 'sample-report.xml';
	$pdf = new PdfToText ($pdf_file, PdfToText::PDFOPT_CAPTURE);
	$pdf -> SetCaptures ($xml_file);
	$captures = $pdf -> GetCaptures( );

	$dadosContratante = ((string) $captures -> Title[1]);
	$arrayContratante = explode("COD.: ", $dadosContratante);


rename($diretorio . $value, $diretorio . $key . " " . rtrim($arrayContratante[0]) . " - " . $arrayContratante[1] . ".pdf");

	echo "Arquivo " . $value . " renomeado para " . $key . " " . rtrim($arrayContratante[0]) . " - " . $arrayContratante[1] . ".pdf" . "<br>";

//echo ( "Document header title : " . ( ( string ) $captures -> Title[1] ) . "\n" ) ;


//print_r($captures);

}






?>

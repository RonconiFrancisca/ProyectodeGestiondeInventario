<?php
ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);

require_once __DIR__ . '/libs/tcpdf/tcpdf.php';
require_once __DIR__ . '/../DataBase.php';
require_once __DIR__ . '/../Clases/Movimiento.php';

$movimientos = Movimiento::obtenerMovimientos($bd);

$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Sistema de Inventario');
$pdf->SetTitle('Historial de Movimientos');
$pdf->SetMargins(10, 10, 10);
$pdf->AddPage();
$pdf->SetFont('Helvetica', '', 10);

$fecha = date('d/m/Y H:i');
$html = '
<h1 style="text-align:center; font-family:Helvetica; font-size:16pt;">Historial de Movimientos</h1>
<p style="text-align:center; font-size:10pt; color:#555;">Listado de movimientos registrados al ' . $fecha . '</p>
<br><br>
<table border="1" cellpadding="5" cellspacing="0" style="width:100%; font-size:10pt;">
  <thead>
    <tr style="background-color:#f2f2f2;">
      <th style="text-align:center; font-weight:bold;">ID</th>
      <th style="text-align:center; font-weight:bold;">Código</th>
      <th style="text-align:center; font-weight:bold;">Nombre</th>
      <th style="text-align:center; font-weight:bold;">Cantidad</th>
      <th style="text-align:center; font-weight:bold;">Tipo</th>
      <th style="text-align:center; font-weight:bold;">Fecha</th>
      <th style="text-align:center; font-weight:bold;">Precio Unitario</th>
      <th style="text-align:center; font-weight:bold;">Total</th>
    </tr>
  </thead>
  <tbody>';

if ($movimientos) {
    foreach ($movimientos as $m) {
        $tipo = $m['ingreso'] ? 'Entrada' : 'Salida';
        $html .= '<tr>
                    <td style="text-align:center; padding:4px;">'.$m["id_movimiento"].'</td>
                    <td style="text-align:center; padding:4px;">'.$m["codigo"].'</td>
                    <td style="text-align:center; padding:4px;">'.$m["nombre_producto"].'</td>
                    <td style="text-align:center; padding:4px;">'.$m["cantidad"].'</td>
                    <td style="text-align:center; padding:4px;">'.$tipo.'</td>
                    <td style="text-align:center; padding:4px;">'.$m["fecha"].'</td>
                    <td style="text-align:center; padding:4px;">$'.number_format($m["precio"], 2, ',', '.').'</td>
                    <td style="text-align:center; padding:4px;">$'.number_format($m["total"], 2, ',', '.').'</td>
                  </tr>';
    }
} else {
    $html .= '<tr><td colspan="8" style="text-align:center; padding:6px;">No hay movimientos registrados</td></tr>';
}

$html .= '
  </tbody>
</table>
<br><br>
<p style="text-align:right; font-size:9pt; color:#666;">Generado automáticamente por el sistema de inventario</p>';

$pdf->writeHTML($html, true, false, true, false, '');

$fechaArchivo = date('d-m-Y');
$nombreArchivo = "historial_movimientos_$fechaArchivo.pdf";
$pdf->Output($nombreArchivo, 'D');

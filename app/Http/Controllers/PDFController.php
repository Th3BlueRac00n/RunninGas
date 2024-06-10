<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PDFController extends Controller
{
    public function generarPdf(Request $request)
    {
        //Generar QR
        $qrCodeImage = base64_encode(QrCode::format('png')->size(200)->generate('hola'));

        // HTML que quieres convertir a PDF
        $html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Inscripcion PDF</title>
</head>
<body>
  <div id="contenedorPrincipalPdf">
        <div id="contenedorArribaPdf">
            <div id="ArribaPdf">
                <span>JUSTIFICANTE DE INSCRIPCION</span>
                <div class="filaArribaPdf">
                    <div class="propiedadesCarrera">
                        Evento
                    </div>
                    <div class="propiedadesCarrera">
                        Información
                    </div>
                </div>
                <div class="filaArribaPdf">
                    <div class="propiedadesCarrera">
                        Modo de pago
                    </div>
                    <div class="propiedadesCarrera">
                        Fecha
                    </div>
                    <div class="propiedadesCarrera">
                        Estado inscripcion
                    </div>
                </div>
                <div class="filaArribaPdf">
                    <div class="propiedadesCarrera">
                        P
                    </div>
                    <div class="propiedadesCarrera">
                        Información
                    </div>
                </div>
            </div>

        </div>
        <div id="contenedorAbajoPdf">
    <div id="numeroDorsal">
    Dorsal asignado:
    </div>
    <div>
        <table>
            <tr>
                <td>Nombre</td>
                <td>Nombre</td>
            </tr>
            <tr>
                <td>Apellidos</td>
                <td>Nombre</td>
            </tr>
            <tr>
                <td>DNI</td>
                <td>Nombre</td>
            </tr>
            <tr>
                <td>Sexo</td>
                <td>Nombre</td>
            </tr>
            <tr>
                <td>Fecha nacimiento</td>
                <td>Nombre</td>
            </tr>
            <tr>
                <td>Correo electronico</td>
                <td>Nombre</td>
            </tr>
            <tr>
                <td>Telefono</td>
                <td>Nombre</td>
            </tr>
        </table>
    </div>
    <div id="Precio">
        Precio
    </div>
</div>

</div>
</body>
</html>';

        // Configurar Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        // Crear instancia de Dompdf
        $dompdf = new Dompdf($options);

        // Cargar HTML
        $dompdf->loadHtml($html);

        // Renderizar PDF
        $dompdf->render();

        // Generar nombre de archivo
        $nombreArchivo = 'InscripcionPrueba' . time() . '.pdf';

        // Descargar PDF
        return $dompdf->stream($nombreArchivo);
    }
}

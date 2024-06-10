<?php

namespace App\Http\Controllers;

use App\Models\Carreras;
use App\Models\Direccion;
use App\Models\Inscripcion;
use App\Models\Usuario;
use App\Models\UsuarioCarrera;
use Dompdf\Dompdf;
use Dompdf\Options;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Http\Request;

class InscripcionController extends Controller
{
    public function mostrarFormulario($idCarrera)
    {
        $usuarioId = session('id');
        $usuario = Usuario::with('equipo')->find($usuarioId);
        $direccion = Direccion::where('id_usuario', $usuarioId)->first();

        return view('crearInscripcion', [
            'idCarrera' => $idCarrera,
            'usuario' => $usuario,
            'direccion' => $direccion
        ]);
    }

    public function obtenerUltimoDorsal($idCarrera)
    {
        $ultimoDorsal = Inscripcion::where('id_carrera', $idCarrera)->max('dorsal');
        return response()->json(['ultimoDorsal' => $ultimoDorsal]);
    }

    public function añadirInscripcion(Request $request, $idCarrera)
    {
        if (!session()->has('id')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para inscribirte.');
        }

        $usuarioId = session('id');
        $usuario = Usuario::with('equipo')->find($usuarioId);

        // Verificar si ya está inscrito en esta carrera
        $inscripcionExistente = Inscripcion::where('id_usuario', $usuarioId)
            ->where('id_carrera', $idCarrera)
            ->first();
        if ($inscripcionExistente) {
            return redirect()->route('verPerfil')->with('error', 'Ya estás inscrito en esta carrera.');
        }

        // Validar los campos del formulario
        $request->validate([
            'forma_pago' => ['required', 'in:tarjeta de credito,transferencia bancaria,efectivo'],
            'carnetJoven' => ['required', 'boolean'],
            'modalidad' => ['required', 'in:individual,duo,trio,equipo'],
            'categoria' => ['required', 'in:femenino,masculino,mixto'],
            'dorsal' => ['required', 'numeric'],
            'recogida_dorsal' => ['required', 'in:oficina,carrera'],
        ]);

        // Obtener el precio base de la carrera
        $carrera = Carreras::find($idCarrera);
        $precioCarrera = $carrera->precio;


        //DESCUENTOS
        $descuento = 0;


        //srtotime para la fecha a string para operar
        $fechaCarrera = strtotime($carrera->fecha);
        $fechaActual = strtotime(date('Y-m-d'));

        $diferenciaDias = ($fechaCarrera - $fechaActual) / (60 * 60 * 24);
        if ($diferenciaDias >= 50) {
            $descuento = 2;
        }

        //$usuario->equipo
        if ($usuario != null) {
            $descuento = 3;
        }
        //Si tiene carnet joven descuento de 4 euros
        if ($request->carnetJoven) {
            $descuento = 3; // Restar 4 euros al precio final
        }

        //Calculando los días de diferencia segundos* minutos* horas
        $diferenciaDias = ($fechaCarrera - $fechaActual) / (60 * 60 * 24);
        if ($diferenciaDias >= 60) {
            $descuento = 4;
        }

        // Aplicar el descuento al precio de la carrera
        $precioFinal = $precioCarrera - $descuento;

        // Crear la inscripción
        $inscripcion = new Inscripcion();
        $inscripcion->forma_pago = $request->forma_pago;
        $inscripcion->carnetJoven = $request->carnetJoven;
        $inscripcion->modalidad = $request->modalidad;
        $inscripcion->categoria = $request->categoria;
        $inscripcion->dorsal = $request->dorsal;
        $inscripcion->fecha_inscripcion = now();
        $inscripcion->recogida_dorsal = $request->recogida_dorsal;
        $inscripcion->id_usuario = $usuarioId;
        $inscripcion->id_carrera = $idCarrera;
        $inscripcion->save();

        $usuarioCarrera = new UsuarioCarrera();
        $usuarioCarrera->id_usuario = session('id');
        $usuarioCarrera->id_carrera = $idCarrera;
        $usuarioCarrera->save();

        // Crear un arreglo con todos los datos necesarios para el PDF
        $inscripcionData = [
            'usuario' => $usuario,
            'inscripcion' => $inscripcion,
            'carrera' => $carrera,
            'precioCarrera' => $precioFinal,
            'tituloCarrera' => $carrera->titulo,
            'modalidad' => $inscripcion->modalidad,
            'categoria' => $inscripcion->categoria,
            'fechaInscripcion' => $inscripcion->fecha_inscripcion,
            'recogidaDorsal' => $inscripcion->recogida_dorsal,
            'formaPago' => $inscripcion->forma_pago,
            'dorsal' => $inscripcion->dorsal,
        ];

        $pdf = $this->generarPdf($inscripcionData);
        return $pdf;
    }


    private function generarPdf($data)
    {
        $usuario = $data['usuario'];
        $inscripcion = $data['inscripcion'];
        $carrera = $data['carrera'];
        $precioFinal = $data['precioCarrera'];
        $tituloCarrera = $data['tituloCarrera'];
        $modalidad = $data['modalidad'];
        $categoria = $data['categoria'];
        $fechaInscripcion = $data['fechaInscripcion'];
        $recogidaDorsal = $data['recogidaDorsal'];
        $formaPago = $data['formaPago'];
        $dorsal = $data['dorsal'];

        $nombre = $usuario->nombre;
        $apellido1 = $usuario->apellido1;
        $apellido2 = $usuario->apellido2;
        $dni = $usuario->dni;
        $sexo = $usuario->sexo;
        $fecha_nacimiento = $usuario->fecha_nacimiento;
        $correo = $usuario->correo;

        $qrCode = new QrCode('Corredor inscrito en RunninGas: ' . $nombre . ' ' . $apellido1 . ' ' . $apellido2);
        $qrCode->setSize(150);
        $writer = new PngWriter();
        $qrCodeImage = $writer->write($qrCode)->getDataUri();

        $html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Inscripcion PDF</title>
    <style>
    #contenedorPrincipalPdf {
        width: 90%;
        left: 5%;
        position: relative;
      }
    #ArribaPdf h1{
        text-align: center;
        display: flex;
      }
    .filaArribaPdf{
        display: flex;
        text-align: center;
    }
    .propiedadesCarrera{
        width: 60%;
        border: 2px solid orange;
      margin: 10px;
      height: 50px;
    }
    #numeroDorsal{
        font-size: 40px;
        color: white;
        background-color: orange;
        text-align: center;
       margin: 2%;
      padding: 10px;
    }
    table{
        width: 80%;
      position: relative;
      left: 10%;
    }
    table td{
        height: 30px;
        font-size: 20px;
        border: none;
        border-bottom: 2px solid rgb(193, 164, 98);

    }
    #Precio{
        font-size: 30px;
        color: white;
        background-color: orange;
        text-align: center;
        margin: 2%;
        padding: 20px;
    }
    </style>
</head>
<body>
  <div id="contenedorPrincipalPdf">
        <div id="contenedorArribaPdf">
            <div id="ArribaPdf">
                <h1>  Inscripcion ' . $tituloCarrera . '</h1>
                <img src="' . $qrCodeImage . '" alt="Código QR">

                <div class="filaArribaPdf">
                    <div class="propiedadesCarrera">
                    <p>Modalidad: ' . $modalidad . '</p>
                    </div>
                    <div class="propiedadesCarrera">
                       <p>Categoria de la inscripcion:  ' . $categoria . '</p>
                    </div>
                </div>
                <div class="filaArribaPdf">
                    <div class="propiedadesCarrera">
                    <p>Fecha de inscripcion: ' . $fechaInscripcion . '</p>
                    </div>
                    <div class="propiedadesCarrera">
                      <p>El dorsal se recogera en: ' . $recogidaDorsal . '</p>
                    </div>
                    <div class="propiedadesCarrera">
                     <p>Forma de pago: ' . $formaPago . '</p>
                    </div>
                </div>
            </div>

        </div>
        <div id="contenedorAbajoPdf">
    <div id="numeroDorsal">
    Dorsal asignado: ' . $dorsal . '
    </div>
    <div>
        <table>
            <tr>
                <td>Nombre</td>
                <td>' . $nombre . '</td>
            </tr>
            <tr>
                <td>Apellidos</td>
                <td>' . $apellido1 . ' ' . $apellido2 . '</td>
            </tr>
            <tr>
                <td>DNI</td>
                <td>' . $dni . '</td>
            </tr>
            <tr>
                <td>Sexo</td>
                <td>' . $sexo . '</td>
            </tr>
            <tr>
                <td>Fecha de nacimiento</td>
                <td>' . $fecha_nacimiento . '</td>
            </tr>
            <tr>
                <td>Correo</td>
                <td>' . $correo . '</td>
            </tr>
        </table>
        <div id="Precio">
            Precio: ' . $precioFinal . '€
        </div>
    </div>
    </div>
    </div>
</body>
</html>';

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Generar nombre de archivo
        $nombreArchivo = 'InscripcionPrueba' . time() . '.pdf';

        // Descargar PDF
        return $dompdf->stream($nombreArchivo);
    }
}

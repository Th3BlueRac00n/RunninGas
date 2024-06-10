<?php

use App\Http\Controllers\CarrerasController;
use App\Http\Controllers\ComentariosController;
use App\Http\Controllers\EquiposController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NoticiasController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');
//Route::middleware('auth')->group(function () {
Route::get('/runninGas', [IndexController::class, 'index'])->name('runninGas');
//});
Route::get('/listarUsuarios', [UsuariosController::class, 'listarUsuarios'])->name('listarUsuarios');
Route::get('/listarNoticias', [NoticiasController::class, 'listarNoticias'])->name('listarNoticias');
Route::get('/listarCarreras', [CarrerasController::class, 'listarCarreras'])->name('listarCarreras');
Route::get('/listarEquipos', [EquiposController::class, 'listarEquipos'])->name('listarEquipos');

Route::get('/cerrarSesion', [LoginController::class, 'cerrarSesion'])->name('cerrarSesion');

Route::view('/control',"control")->name('control');
Route::view('/login',"login")->name('login');
Route::view('/registro',"registro")->name('registro');
Route::view('/noticias', 'noticias')->name('noticias');
Route::view('/carreras',"carreras")->name('carreras');
Route::view('/cambiarContrasena', 'cambiarContrasena')->name('cambiarContrasena');
Route::get('/verPerfil', [UsuariosController::class, 'verPerfil'])->name('verPerfil');
Route::post('/guardarPerfil', [UsuariosController::class, 'guardarPerfil'])->name('guardarPerfil');

//Route::view('/cambiarContrasena',"cambiarContrasena")->name('cambiarContrasena');

Route::post('/cambiarContrasena', [UsuariosController::class, 'cambiarContrasena'])->name('cambiarContrasena');

Route::view('/crearNoticia',"crearNoticia")->name('crearNoticia');
Route::view('/crearCarrera',"crearCarrera")->name('crearCarrera');
Route::view('/crearEquipo',"crearEquipo")->name('crearEquipo');

//Formularios Login y Registro
Route::post('/registro',[RegistroController::class,'crearUsuario']);
Route::post('/login',[LoginController::class,'checkLogin']);
Route::post('/crearNoticia', [NoticiasController::class,'agregarNoticia'])->name('agregarNoticia');

Route::post('/crearCarrera', [CarrerasController::class,'agregarCarrera'])->name('agregarCarrera');

Route::post('/crearEquipo', [EquiposController::class,'agregarEquipo'])->name('agregarEquipo');

Route::get('/hacerAdmin/{usuario}', [UsuariosController::class, 'hacerAdmin'])->name('hacerAdmin');
Route::get('/eliminarUsuario/{usuario}', [UsuariosController::class, 'eliminarUsuario'])->name('eliminarUsuario');

Route::delete('/eliminarNoticia/{noticia}', [NoticiasController::class, 'eliminarNoticia'])->name('eliminarNoticia');
Route::delete('/eliminarCarrera/{carrera}', [CarrerasController::class,'eliminarCarrera'])->name('eliminarCarrera');
Route::delete('/eliminarEquipo/{equipo}', [EquiposController::class,'eliminarEquipo'])->name('eliminarEquipo');

Route::get('/editarNoticia/{id}', [NoticiasController::class, 'editarNoticia'])->name('editarNoticia');
Route::put('/actualizarNoticia/{noticia}', [NoticiasController::class, 'actualizarNoticia'])->name('actualizarNoticia');

Route::get('/editarCarrera/{id}', [CarrerasController::class,'editarCarrera'])->name('editarCarrera');
Route::put('/actualizarCarrera/{carrera}', [CarrerasController::class,'actualizarCarrera'])->name('actualizarCarrera');

Route::get('/editarPerfil', [UsuariosController::class, 'editarPerfil'])->name('editarPerfil');
Route::post('/guardarPerfil', [UsuariosController::class, 'guardarPerfil'])->name('guardarPerfil');
Route::put('/actualizarPerfil/{usuario}', [UsuariosController::class,'actualizarPerfil'])->name('actualizarPerfil');

Route::get('/editarEquipo/{id}', [EquiposController::class, 'editarEquipo'])->name('editarEquipo');
Route::put('/actualizarEquipo/{equipo}', [EquiposController::class, 'actualizarEquipo'])->name('actualizarEquipo');

Route::get('/carreras', [CarrerasController::class, 'mostrarCarreras'])->name('carreras');
Route::get('/carrera/{id}', [CarrerasController::class, 'detalleCarrera'])->name('carrera');
Route::get('/carrera/{id}', [CarrerasController::class, 'mostrarCarrera'])->name('carrera');

//Filtro de carreras
Route::get('/filtrarCarreras', [CarrerasController::class, 'filtrarCarreras'])->name('filtrarCarreras');

Route::get('/noticias', [NoticiasController::class, 'mostrarNoticias'])->name('noticias');
Route::get('/noticias/{id}', [NoticiasController::class, 'verNoticia'])->name('noticia');

Route::post('/guardar-comentario', [ComentariosController::class, 'guardar'])->name('guardarComentario');

Route::get('/usuario/{id}', [UsuariosController::class, 'mostrarUsuario'])->name('mostrarUsuario');

Route::get('/', [IndexController::class, 'index'])->name('index');

//Inscripcion
Route::get('/crearInscripcion/{idCarrera}', [InscripcionController::class, 'mostrarFormulario'])->name('crearInscripcion');
Route::post('/añadirInscripcion/{idCarrera}', [InscripcionController::class, 'añadirInscripcion'])->name('añadirInscripcion');

Route::get('/inscripcion/{idCarrera}', [InscripcionController::class, 'mostrarFormulario'])->name('mostrarFormulario');
Route::get('/ultimo-dorsal/{idCarrera}', [InscripcionController::class, 'obtenerUltimoDorsal'])->name('obtenerUltimoDorsal');

Route::post('/generar-pdf', [PDFController::class, 'generarPdf'])->name('generarPdf');

//Equipo
Route::get('/registro', [RegistroController::class, 'showRegistrationForm'])->name('registro');
// Ruta para manejar la creación del usuario
Route::post('/registro', [RegistroController::class, 'crearUsuario'])->name('crearUsuario');




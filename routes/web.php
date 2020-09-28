<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/{stand}', 'HomeController@home_stand')->name('home_');
Route::get('/registrado',  function () {
    return view('auth.register-success');
});
Route::get('visita','HomeController@visita')->name('visita');
Route::post('visita','HomeController@mapa')->name('mapa');
/*Route::get('visita',function () {
    return view('welcome');
})->name('visita');*/
Route::get('auditorio','HomeController@auditorio')->name('auditorio');
Route::get('auditorio/{id}','HomeController@teatro')->name('teatro');
Route::get('pabellon/{pabellon}', 'HomeController@pabellon')->name('pabellon');
Route::get('visita_stand/{stand}', 'HomeController@visita_stand')->name('visita_stand');
/*Route::get('auditorio',function () {
    return view('welcome');
})->name('auditorio');
Route::get('auditorio/{id}',function () {
    return view('welcome');
})->name('teatro');
Route::get('pabellon/{pabellon}', function () {
    return view('welcome');
})->name('pabellon');
Route::get('visita_stand/{stand}', function () {
    return view('welcome');
})->name('visita_stand');*/
Route::get('l/{id}','HomeController@login_sistema');
Route::post('/contrato', 'HomeController@contrato')->name('contrato');
Route::post('/pago', 'HomeController@pago')->name('pago');
Route::get('/organizadores', 'HomeController@organizadores')->name('organizadores');
Route::get('/actividades-paralelas', 'HomeController@actividades_paralelas')->name('actividades-paralelas');
Route::get('/el-evento', 'HomeController@el_evento')->name('el-evento');
Route::get('/quiero-participar', 'HomeController@quiero_participar')->name('quiero-participar');
Route::get('/empresa', 'HomeController@datos_empresa')->name('datos-empresa');
Route::get('/empresa/{stand}', 'HomeController@datos_empresa_stand')->name('datos-empresa1');
Route::get('/productos', 'HomeController@productos')->name('productos');
Route::get('/ofertas', 'HomeController@ofertas')->name('ofertas');
Route::get('/productos/{stand}', 'HomeController@productos_stand')->name('productos1');
Route::get('/ofertas/{stand}', 'HomeController@ofertas_stand')->name('ofertas1');
Route::post('/guardar_stand', 'HomeController@guardar_stand')->name('guardar-stand');
Route::post('/guardar_stand/{stand}', 'HomeController@guardar_stands')->name('guardar-stands');
Route::post('/empresa', 'HomeController@guardar_datos_empresa')->name('guardar-empresa');
Route::post('/sucursales', 'HomeController@guardar_sucursales')->name('guardar-sucursales');
Route::post('/empresa/{stand}', 'HomeController@guardar_datos_empresa_stand')->name('guardar-empresa-stand');
Route::post('/sucursales/{stand}', 'HomeController@guardar_sucursales_stand')->name('guardar-sucursales-stand');
Route::post('/ofertas', 'HomeController@guardar_ofertas')->name('guardar-ofertas');
Route::post('/productos', 'HomeController@guardar_productos')->name('guardar-productos');
Route::post('/ejecutivos', 'HomeController@guardar_ejecutivos')->name('guardar-ejecutivos');
Route::post('/ejecutivos/{stand}', 'HomeController@guardar_ejecutivos_stand')->name('guardar-ejecutivos-stand');
Route::post('/ofertas/{stand}', 'HomeController@guardar_ofertas_stand')->name('guardar-ofertas-stand');
Route::post('/productos/{stand}', 'HomeController@guardar_productos_stand')->name('guardar-productos-stand');
Route::get('/wpp/{stand}/{wpp}/{texto}', 'ActividadController@whatsapp')->name('whatsapp');
Route::get('/fb/{stand}', 'ActividadController@facebook')->name('facebook');
Route::get('/ig/{stand}', 'ActividadController@instagram')->name('instagram');
Route::get('/tw/{stand}', 'ActividadController@twitter')->name('twitter');
Route::get('/yt/{stand}', 'ActividadController@youtube')->name('youtube');
Route::get('/ej/{stand}/{ejecutivo}', 'ActividadController@ejecutivo')->name('ejecutivo');
Route::get('/eliminar_ejecutivo/{id}', 'HomeController@eliminar_ejecutivo')->name('eliminar-ejecutivos');
Route::get('/eliminar_sucursal/{id}', 'HomeController@eliminar_sucursal')->name('eliminar-sucursal');
Route::get('/eliminar_producto/{id}', 'HomeController@eliminar_productos')->name('eliminar-producto');
Route::get('/eliminar_oferta/{id}', 'HomeController@eliminar_ofertas')->name('eliminar-oferta');
Route::get('/previa_stand', 'HomeController@previa_stand')->name('previa-stand');
Route::get('/previa_stand/{stand}', 'HomeController@previa_stand_1')->name('previa-stand1');
Route::post('encuesta/{id}','HomeController@encuesta');
Route::get('informe/{id}','HomeController@informe');

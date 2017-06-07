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

// Route Select2
Route::get('select2-autocomplete', 'Select2AutocompleteController@layout');
Route::get('select2-autocomplete-ajax', 'Select2AutocompleteController@getComuni');

// Schermata iniziale di login

Route::get('/', function () {
    return view('caf.index');
});

/*
    Route della dashboard
 */
Route::get('/dashboard', function(){
    return view('caf.section.dashboard');
});

/*
    Route della gestione utenti
 */
Route::get('/gestione_utenti', function(){
    return view('caf.section.gestione_utenti');
});

/*
    Route della gestione menu a tendina
 */
Route::get('/gestione_tendine', function(){
    return view('caf.section.gestione_tendine');
})->name('visualizzaGestioneTendine');

Route::post('/inserisci_tipo_invalidita','GestioneTendineController@inserisciTipoInvalidita');
Route::post('/inserisci_titolo_studio','GestioneTendineController@inserisciTitoloStudio');
Route::post('/inserisci_tipo_professione','GestioneTendineController@inserisciTipoProfessione');
Route::post('/inserisci_tipo_documento','GestioneTendineController@inserisciTipoDocumento');
Route::get('/rimuovi_tipo_invalidita/{id}','GestioneTendineController@rimuoviTipoInvalidita');
Route::get('/rimuovi_titolo_studio/{id}','GestioneTendineController@rimuoviTitoloStudio');
Route::get('/rimuovi_tipo_professione/{id}','GestioneTendineController@rimuoviTipoProfessione');
Route::get('/rimuovi_tipo_documento/{id}','GestioneTendineController@rimuoviTipoDocumento');

/* Route resource Clienti */
Route::resource('clienti', 'ClientiController');

// Route per l'autenticazione built in di laravel

Auth::routes();

Route::get('/home', function () {
    return view('home');
});

// Route del template di base

Route::get('/template/dashboard', function () {
    return view('bootstrap_template.section.dashboard');
});

Route::get('/template/user', function () {
    return view('bootstrap_template.section.user');
});

Route::get('/template/table', function () {
    return view('bootstrap_template.section.table');
});

Route::get('/template/typography', function () {
    return view('bootstrap_template.section.typography');
});

Route::get('/template/icons', function () {
    return view('bootstrap_template.section.icons');
});

Route::get('/template/notifications', function () {
    return view('bootstrap_template.section.notifications');
});

Route::get('/template/upgrade', function () {
    return view('bootstrap_template.section.upgrade');
});
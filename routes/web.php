<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::middleware(['auth'])->group(function () {
    Route::get('data_nilai/{siswa_id}', 'ShowController@show')->name('nilai_show');
    Route::get('raport/{siswa_id}', 'ShowController@raport')->name('raport_show');
    Route::get('nilai/export/', 'ShowController@exportNilai')->name('export_nilai');

    Route::resource('absen', 'AbsenController');
    Route::resource('upd', 'UpdController');
    Route::resource('nilai', 'NilaiController');
    Route::resource('raport', 'RaportController');
});

Route::middleware(['auth', 'ceklevel:admin'])->group(function () {
    //Soft Deletes CRUD Siswa
    Route::get('siswa/trash', 'TrashController@siswa')->name('trash.siswa');
    Route::get('siswa/restore/{id}', 'TrashController@restoresiswa')->name('trash.restore');
    Route::get('siswa/restore_all', 'TrashController@restore_allsiswa')->name('restore.siswa');
    Route::get('siswa/delete/{id}', 'TrashController@delete_siswa')->name('delete.siswa');
    Route::get('siswa/deleteall', 'TrashController@delete_all_siswa')->name('deleteall.siswa');

    //Soft Deletes CRUD Rayon
    Route::get('rayon/trash', 'TrashController@rayon')->name('trash.rayon');
    Route::get('rayon/restore/{id}', 'TrashController@restorerayon')->name('trashrayon.restore');
    Route::get('rayon/restore_all', 'TrashController@restore_allrayon')->name('restore.rayon');
    Route::get('rayon/delete/{id}', 'TrashController@delete_rayon')->name('delete.rayon');
    Route::get('rayon/deleteall', 'TrashController@delete_all_rayon')->name('deleteall.rayon');

    //Soft Deletes CRUD Jurusan
    Route::get('jurusan/trash', 'TrashController@jurusan')->name('trash.jurusan');
    Route::get('jurusan/restore/{id}', 'TrashController@restorejurusan')->name('trashjurusan.restore');
    Route::get('jurusan/restore_all', 'TrashController@restore_alljurusan')->name('restore.jurusan');
    Route::get('jurusan/delete/{id}', 'TrashController@delete_jurusan')->name('delete.jurusan');
    Route::get('jurusan/deleteall', 'TrashController@delete_all_jurusan')->name('deleteall.jurusan');

    //Soft Deletes CRUD Guru
    Route::get('guru/trash', 'TrashController@guru')->name('trash.guru');
    Route::get('guru/restore/{id}', 'TrashController@restoreguru')->name('trashguru.restore');
    Route::get('guru/restore_all', 'TrashController@restore_allguru')->name('restore.guru');
    Route::get('guru/delete/{id}', 'TrashController@delete_guru')->name('delete.guru');
    Route::get('guru/deleteall', 'TrashController@delete_all_guru')->name('deleteall.guru');

    //Soft Deletes CRUD Detail UPD
    Route::get('detail/trash', 'TrashController@detail')->name('trash.detail');
    Route::get('detail/restore/{id}', 'TrashController@restoredetail')->name('trashdetail.restore');
    Route::get('detail/restore_all', 'TrashController@restore_alldetail')->name('restore.detail');
    Route::get('detail/delete/{id}', 'TrashController@delete_detail')->name('delete.detail');
    Route::get('detail/deleteall', 'TrashController@delete_all_detail')->name('deleteall.detail');

    Route::resource('siswa', 'SiswaController');
    Route::resource('guru', 'GuruController');
    Route::resource('rayon', 'RayonController');
    Route::resource('mapel', 'MapelController');
    Route::resource('detail', 'DetailController');
    Route::resource('user', 'UserController');
    Route::resource('jurusan', 'JurusanController');
});

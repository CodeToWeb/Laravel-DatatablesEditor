<?php
//DataTables
Route::get('dte', 'DatatablesController@index');
Route::post('data-response', 'DatatablesController@dataResponse');
Route::get('data-response', 'DatatablesController@dataResponse');
Route::controller('datatables', 'DatatablesController', [
    'anyData'  => 'datatables.data',
    'getIndex' => 'datatables'
]);
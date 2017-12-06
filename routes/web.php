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
  return view('home', compact('indices'));
});

Route::get('/indices', function() {
  $indices = App\Index::orderby('position', 'asc')->get();
  foreach ($indices as $index) {
    $index->history = $index->getHistory();
    $history_count = count($index->history);
    if ($history_count >= 2) {
	    $index->increasing = ( $index->history[$history_count - 1]->value > $index->history[$history_count - 2]->value );
	    $index->decreasing = ( $index->history[$history_count - 1]->value < $index->history[$history_count - 2]->value );
    }
  }
  return $indices;
});

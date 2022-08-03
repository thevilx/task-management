<?php

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/update-priority', function (Request $request) {


    foreach($request->order as $data){
        Task::where('id', $data['id'])->update(['priority' => $data['position']]);
    }

    return response()->json(['success' => 'Priority Updated Successfully.']);

})->name('update-priority');

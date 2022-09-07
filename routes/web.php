<?php

use Illuminate\Support\Facades\Route;
use App\Models\Article;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\File;
use PhpParser\Builder\Function_;
use PhpParser\Node\Scalar\MagicConst\Dir;
use Psy\Readline\Hoa\FileDoesNotExistException;
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

function testing($test){

    return var_dump($test);

}

Route::get('', function () {

    return view('welcome');
    
});

Route::get('/Ai',function(){

    return view('Ai');

});

Route::get('/Ai/Heat',function(){

    
    return view('Heat');

});

Route::get('Ai/Cold',function(){
   
    return view('Cold');

});


Route::get('Posts', function () {

    $Articles = Article::all();

    // ddd($Articles);
    
    return view('Posts',[
        
        'Posts'=>$Articles,

    ]);

});


Route::get('/Testing',function(){
    
    $Value = testing(getMonthlyEarning());

    return view('Testing',[

        'Testing' => $Value,

    ]);
    
});


Route::get('/Charts',function(){

    return view('Charts');

});


Route::get('Posts/{Article}', function ($temp) {

    $temp = Article::display($temp);
    // ddd($temp);
    return view('Post', [

        'Article' => Article::display($temp),

    ]);

})->where('Article', '[A-z_/-]+');

<?php

Route::group(['namespace' => 'Pranto\MultiLanguage\Controllers'],function (){
//lang
Route::get('/change-lang/{lang}', 'FrontendController@changeLang')->name('lang');

//language
    Route::get('/language/manager', 'LanguageController@langManage')->name('language-manage');
    Route::post('/language/manager', 'LanguageController@langStore')->name('language-manage-store');
    Route::delete('language-manage/{id}', 'LanguageController@langDel')->name('language-manage-del');
    Route::get('language-key/{id}', 'LanguageController@langEdit')->name('language-key');
    Route::put('key-update/{id}', 'LanguageController@langUpdate')->name('key-update');
    Route::post('language-manage-update/{id}', 'LanguageController@langUpdatepp')->name('language-manage-update');
    Route::post('language-import', 'LanguageController@langImport')->name('import_lang');

});

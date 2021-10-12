<?php

/*
|--------------------------------------------------------------------------
| Webhook route
|--------------------------------------------------------------------------
*/
Route::post('/notification/pim/webhook', '\App\Http\Controllers\WebhookController@subscribe');

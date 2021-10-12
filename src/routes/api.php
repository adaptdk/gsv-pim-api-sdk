<?php

/*
|--------------------------------------------------------------------------
| Webhook route
|--------------------------------------------------------------------------
*/
Route::post('/notification/pim/webhook', 'Adaptdk\PimApi\Controllers\WebhookController@subscribe');

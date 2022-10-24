<?php

use App\Models\Translation;

/*
|--------------------------------------------------------------------------
| Password Reset Language Lines
|--------------------------------------------------------------------------
|
| The following language lines are the default lines which match reasons
| that are given by the password broker for a password update attempt
| has failed, such as for an invalid token or invalid new password.
|
*/

$passwords_translations = Translation::where('page', 'passwords')->get();
$translations_array = [];

foreach ($passwords_translations as $translation) {
    $translations_array[$translation->key] = $translation->de;
}

return $translations_array;


// return [
//     'reset'     => 'Das Passwort wurde zurückgesetzt!',
//     'sent'      => 'Passworterinnerung wurde gesendet!',
//     'throttled' => 'Bitte warten Sie, bevor Sie es erneut versuchen.',
//     'token'     => 'Der Passwort-Wiederherstellungs-Schlüssel ist ungültig oder abgelaufen.',
//     'user'      => 'Es konnte leider kein Nutzer mit dieser E-Mail-Adresse gefunden werden.',
// ];

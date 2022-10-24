<?php

/*
|--------------------------------------------------------------------------
| Validation Language Lines
|--------------------------------------------------------------------------
|
| The following language lines contain the default error messages used by
| the validator class. Some of these rules have multiple versions such
| as the size rules. Feel free to tweak each of these messages here.
|
*/

return [
    'accepted'             => 'D‘Feld :attribute muss akzeptéiert ginn.',
    'accepted_if'          => 'D’Feld :attribute muss akzeptéiert ginn, wa(nn) :other de Wäert :value huet.',
    'active_url'           => 'D’Feld :attribute ass keng gülteg URL.',
    'after'                => 'D’Feld :attribute muss en Datum no dem :date sinn.',
    'after_or_equal'       => 'D’Feld :attribute muss en Datum ab dem :date sinn.',
    'alpha'                => 'D’Feld :attribute däerf just Buschtawen enthalen.',
    'alpha_dash'           => 'D’Feld :attribute däerf just Buschtawen, Zifferen a Gedankestrécher enthalen.',
    'alpha_num'            => 'D’Feld :attribute däerf just Buschtawen an Zifferen enthalen.',
    'array'                => 'D’Feld :attribute muss eng Tabell sinn.',
    'attached'             => ':attribute ass schon ugehaang.',
    'before'               => 'D’Feld :attribute muss en Datum virum :date sinn.',
    'before_or_equal'      => 'D’Feld :attribute muss en Datum bis den :date sinn.',
    'between'              => [
        'array'   => 'D’Tabell :attribute muss :min bis :max Elementer enthalen.',
        'file'    => 'D’Gréisst vum Fichier :attribute muss tëschent :min an :max Kilobyte leien.',
        'numeric' => 'De Wäert vun :attribute muss tëschent :min an :max leien.',
        'string'  => 'Den Text :attribute muss :min bis :max Schrëftzeechen enthalen.',
    ],
    'boolean'              => 'D’Feld :attribute muss richteg oder falsch sinn.',
    'confirmed'            => 'D’Bestätegungsfeld :attribute stëmmt net iwwerteneen.',
    'current_password'     => 'D’Passwuert ass falsch.',
    'date'                 => 'D’Feld :attribute ass kee valabelen Datum.',
    'date_equals'          => 'D’Feld :attribute muss en Datum sinn, deen gläich :date ass.',
    'date_format'          => 'D’Feld :attribute entsprécht net dem Format :format.',
    'declined'             => 'D’Feld :attribute muss ofgeleent ginn.',
    'declined_if'          => 'D’Feld :attribute muss ofgeleent ginn, wann :other de Wäert :value huet.',
    'different'            => 'D’Felder :attribute a(n) :other mussen ënnerschiddlech sinn.',
    'digits'               => 'D’Feld :attribute muss :digits Zifferen hunn.',
    'digits_between'       => 'D’Feld :attribute muss :min bis :max Zifferen hunn.',
    'dimensions'           => 'D’Gréisst vum Bild :attribute ass net konform.',
    'distinct'             => 'D’Feld :attribute huet en duebele Wäert.',
    'email'                => 'D’Feld :attribute muss eng gülteg E-Mail-Adress sinn.',
    'ends_with'            => 'D’Feld :attribute muss mat engem vun dëse Wäerter ophalen: :values',
    'exists'               => 'Dat ausgewielt Feld :attribute ass ongülteg.',
    'file'                 => 'D’Feld :attribute muss eng Datei sinn.',
    'filled'               => 'D’Feld :attribute muss e Wäert enthalen.',
    'gt'                   => [
        'array'   => 'D’Tabell :attribute muss méi wéi :value Elementer enthalen.',
        'file'    => 'D’Gréisst vum Fichier :attribute muss méi wéi :value Kilobyte sinn.',
        'numeric' => 'De Wäert vun :attribute muss méi grouss wéi :value sinn.',
        'string'  => 'Den Text :attribute muss méi wéi :value Schrëftzeechen enthalen.',
    ],
    'gte'                  => [
        'array'   => 'D’Tabell :attribute muss mindestens :value Elementer enthalen.',
        'file'    => 'D’Gréisst vum Fichier :attribute muss mindestens :value Kilobyte sinn.',
        'numeric' => 'De Wäert vu(n) :attribute muss mindestens :value sinn.',
        'string'  => 'Den Text :attribute muss mindestens :value Schrëftzeechen enthalen.',
    ],
    'image'                => 'D’Feld :attribute muss e Bild sinn.',
    'in'                   => 'D’Feld :attribute ass ongülteg.',
    'in_array'             => 'D’Feld :attribute existéiert net am :other.',
    'integer'              => 'D’Feld :attribute muss eng ganz Zuel sinn.',
    'ip'                   => 'D’Feld :attribute muss eng gülteg IP-Adress sinn.',
    'ipv4'                 => 'D’Feld :attribute muss eng gülteg IPv4-Adress sinn.',
    'ipv6'                 => 'D’Feld :attribute muss eng gülteg IPv6-Adress sinn.',
    'json'                 => 'D’Feld :attribute muss e gültegt JSON-Dokument sinn.',
    'lt'                   => [
        'array'   => 'D’Tabell :attribute muss manner wéi :value Elementer enthalen.',
        'file'    => 'D’Gréisst vum Fichier :attribute muss méi kleng wéi :value Kilobyte sinn.',
        'numeric' => 'De Wäert vun :attribute muss méi kleng wéi :value sinn.',
        'string'  => 'Den Text :attribute muss manner wéi :value Schrëftzeechen enthalen.',
    ],
    'lte'                  => [
        'array'   => 'D’Tabell :attribute däerf maximal :value Elementer enthalen.',
        'file'    => 'D’Gréisst vum Fichier :attribute däerf maximal :value Kilobyte sinn.',
        'numeric' => 'De Wäert vu(n) :attribute däerf maximal :value sinn.',
        'string'  => 'Den Text :attribute däerf maximal :value Schrëftzeechen enthalen.',
    ],
    'max'                  => [
        'array'   => 'D’Tabell :attribute däerf net méi wéi :max Elementer enthalen.',
        'file'    => 'D’Gréisst vum Fichier :attribute däerf net méi wéi :max Kilobyte sinn.',
        'numeric' => 'De Wäert vu(n) :attribute däerf net mei grouss wéi :max sinn.',
        'string'  => 'Den Text :attribute däerf net méi wéi :max Schrëftzeechen enthalen.',
    ],
    'mimes'                => 'D’Feld :attribute muss e Fichier vum Typ :values sinn.',
    'mimetypes'            => 'D’Feld :attribute muss e Fichier vum Typ :values sinn.',
    'min'                  => [
        'array'   => 'D’Tabell :attribute muss mindestens :min Elementer enthalen.',
        'file'    => 'D’Gréisst vum Fichier :attribute muss méi grouss wéi :min Kilobyte sinn.',
        'numeric' => 'De Wäert vun :attribute muss mindestens :min sinn.',
        'string'  => 'Den Text :attribute muss mindestens :min Schrëftzeechen enthalen.',
    ],
    'multiple_of'          => 'De Wäert vu(n) :attribute muss e Multipel vun :value sinn',
    'not_in'               => 'Dat ausgewielt Feld :attribute ass net gülteg.',
    'not_regex'            => 'D’Format vum Feld :attribute ass net gülteg.',
    'numeric'              => 'D’Feld :attribute muss eng Zuel enthalen.',
    'password'             => 'D’Passwuert ass net richteg',
    'present'              => 'D’Feld :attribute muss do sinn.',
    'prohibited'           => 'D’Feld :attribute ass verbueden.',
    'prohibited_if'        => 'D’Feld :attribute ass verbueden, wa(nn) :other de Wäert :value huet.',
    'prohibited_unless'    => 'D’Feld :attribute ass verbueden, ausser :other ass e vun de follgende Wäerter :values.',
    'prohibits'            => 'D’Feld :attribute verbitt, dass :other do ass.',
    'regex'                => 'D’Format vum Feld :attribute ass ongülteg.',
    'relatable'            => ':attribute hänkt warscheinlech net mat dëser Donnée zesummen.',
    'required'             => 'D’Feld :attribute ass obligatoresch.',
    'required_if'          => 'D’Feld :attribute ass obligatoresch, wann de Wäert vun :other :value ass.',
    'required_unless'      => 'D’Feld :attribute ass obligatoresch ausser w(ann) :other :values ass.',
    'required_with'        => 'D’Feld :attribute ass obligatoresch, wa(nn) :values do ass.',
    'required_with_all'    => 'D’Feld :attribute ass obligatoresch, wa(nn) :values do sinn.',
    'required_without'     => 'D’Feld :attribute ass obligatoresch, w(ann) :values net do ass.',
    'required_without_all' => 'D’Feld :attribute ass obligatoresch, wa(nn) :values net so sinn.',
    'same'                 => 'D’Felder :attribute a(n) :other mussen identesch sinn.',
    'size'                 => [
        'array'   => 'D’Tabell :attribute muss :size Elementer enthalen.',
        'file'    => 'D’Gréisst vum Fichier :attribute muss :size Kilobyte sinn.',
        'numeric' => 'De Wäert vu(n) :attribute muss :size sinn.',
        'string'  => 'Den Text vu(n) :attribute muss :size Schrëftzeechen enthalen.',
    ],
    'starts_with'          => 'D’Feld :attribute muss mat engem vun de follgende Wäerter ufänken: :values',
    'string'               => 'D’Feld :attribute muss eng Zeecheketten sinn.',
    'timezone'             => 'D’Feld :attribute muss eng gülteg Zäitzon sinn.',
    'unique'               => 'De Wäert vun Feld :attribute gouf scho benotzt.',
    'uploaded'             => 'De Fichier vum Feld :attribute konnt net eropgelueden ginn.',
    'url'                  => 'D’Format vun der URL vu(n) :attribute ass net gülteg.',
    'uuid'                 => 'D’Feld :attribute muss e gültegen UUID sinn.',
    'custom'               => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'email' => "D'E-Mail Adress",
        'register_password' => "D'Passwuert",
        'register_company' => "D'Entreprise",
        'register_phone' => "D'Telefonsnummer",
        'register_gender' => "D'Geschlecht",
        'register_first_name' => "De Virnumm",
        'register_last_name' => "De Familljennumm",
        'register_age' => "Den Alter",
        'register_legal' => "Legal Alter an Rechter",
        'register_newsletter' => "D’Newsletter",
        'register_address_name' => "Den Numm vun der Adress",
        'register_address_first_name' => "Den Virnumm fir d'Adress",
        'register_address_last_name' => "De Familljennumm fir d'Adress",
        'register_address_number' => "Hausnummer",
        'register_address_street' => "Den Numm vun der Strooss",
        'register_address_floor' => "Adresszousaz",
        'register_address_city' => "D'Stad fir d'Adress",
        'register_address_zip' => "De Postleitzuel fir d'Adress",
        'register_address_phone' => "D'Telefonsnummer fir d'Adress",
        'register_address_country' => "D'Land fir d'Adress",
        'register_address_other' => "Zousätzlech Informatioun fir d'Adress",
        'register_kulturpass' => "D'Dokument Kulturpass",

    ],
];

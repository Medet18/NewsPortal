<?php

return array(

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


    "accepted" => ":Attribute қабылдануы керек.",
    "accepted_if"=> "The :attribute must be accepted when :other is :value.",
    "active_url"=> ":Attribute жарамды URL мекенжайы емес.",
    "after"=> ":Attribute мәні :date күнінен кейінгі күн болуы керек.",
    "after_or_equal"=> ":Attribute мәні :date күнінен кейінгі күн немесе тең болуы керек.",
    "alpha"=> ":Attribute тек әріптерден тұруы керек.",
    "alpha_dash"=> ":Attribute тек әріптерден, сандардан және сызықшалардан тұруы керек.",
    "alpha_num"=> ":Attribute тек әріптерден және сандардан тұруы керек.",
    "array"=> ":Attribute жиым болуы керек.",
    "attached"=> "Бұл нөмір :attribute тіркелген.",
    "before"=> ":Attribute мәні :date күнінен дейінгі күн болуы керек.",
    "before_or_equal"=> ":Attribute мәні :date күнінен дейінгі күн немесе тең болуы керек.",
    "between"=> array(
        "array"=> ":Attribute жиымы :min және :max аралығындағы элементтерден тұруы керек.",
        "file"=> ":Attribute көлемі :min және :max килобайт аралығында болуы керек.",
        "numeric"=> ":Attribute мәні :min және :max аралығында болуы керек.",
        "string"=> ":Attribute тармағы :min және :max аралығындағы таңбалардан тұруы керек.",
    ),
    "boolean"=> ":Attribute жолы шын немесе жалған мән болуы керек.",
    "confirmed"=> ":Attribute растауы сәйкес емес.",
    "current_password"=> "The password is incorrect.",
    "date"=> ":Attribute жарамды күн емес.",
    "date_equals"=> ":Attribute мәні :date күнімен тең болуы керек.",
    "date_format"=> ":Attribute пішімі :format пішіміне сай емес.",
    "declined"=> "The :attribute must be declined.",
    "declined_if"=> "The :attribute must be declined when :other is :value.",
    "different"=> ":Attribute және :other әр түрлі болуы керек.",
    "digits"=> ":Attribute мәні :digits сан болуы керек.",
    "digits_between"=> ":Attribute мәні :min және :max аралығындағы сан болуы керек.",
    "dimensions"=> ":Attribute сурет өлшемі жарамсыз.",
    "distinct"=> ":Attribute жолында қосарланған мән бар.",
    "doesnt_end_with"=> "The :attribute may not end with one of the following: :values.",
    "doesnt_start_with"=> "The :attribute may not start with one of the following: :values.",
    "email"=> ":Attribute жарамды электрондық пошта мекенжайы болуы керек.",
    "ends_with"=> ":Attribute келесі мәндердің біреуінен аяқталуы керек: :values",
    "enum"=> "The selected :attribute is invalid.",
    "exists"=> "таңдалған :attribute жарамсыз.",
    "failed"=> "Тіркелгі деректері біздің жазбаларымызға сай емес.",
    "file"=> ":Attribute файл болуы тиіс.",
    "filled"=> ":Attribute жолы толтырылуы керек.",
    "gt" => array(
        "array"=> ":Attribute мәні :value элементтерден үлкен болуы керек.",
        "file"=> ":Attribute файл өлшемі :value килобайттан үлкен болуы керек.",
        "numeric"=> ":Attribute мәні :value үлкен болуы керек.",
        "string"=> ":Attribute мәні :value таңбалардан үлкен болуы керек.",
    ),
    "gte"=> array(
        "array"=> ":Attribute мәні :value элементтерден үлкен немесе тең болуы керек.",
        "file"=> ":Attribute файл өлшемі :value килобайттан үлкен немесе тең болуы керек.",
        "numeric"=> ":Attribute мәні :value үлкен немесе тең болуы керек.",
        "string"=> ":Attribute мәні :value таңбалардан үлкен немесе тең болуы керек.",
    ),
    "image"=> ":Attribute кескін болуы керек.",
    "in"=> "таңдалған :attribute жарамсыз.",
    "in_array"=> ":Attribute жолы :other ішінде жоқ.",
    "integer"=> ":Attribute бүтін сан болуы керек.",
    "ip"=> ":Attribute жарамды IP мекенжайы болуы керек.",
    "ipv4"=> ":Attribute жарамды IPv4 мекенжайы болуы керек.",
    "ipv6"=> ":Attribute жарамды IPv6 мекенжайы болуы керек.",
    "json"=> ":Attribute жарамды JSON тармағы болуы керек.",
    "lt"=> array(
        "array"=> ":Attribute мәні :value элементтерден кіші болуы керек.",
        "file"=> ":Attribute файл өлшемі :value килобайттан кіші болуы керек.",
        "numeric"=> ":Attribute мәні :value кіші болуы керек.",
        "string"=> ":Attribute мәні :value таңбалардан кіші болуы керек.",
    ),
    "lte"=> array(
        "array"=> ":Attribute мәні :value элементтерден кіші немесе тең болуы керек.",
        "file"=> ":Attribute файл өлшемі :value килобайттан кіші неменсе тең болуы керек.",
        "numeric"=> ":Attribute мәні :value кіші немесе тең болуы керек.",
        "string"=> ":Attribute мәні :value таңбалардан кіші немесе тең болуы керек.",
    ),
    "mac_address"=> "The :attribute must be a valid MAC address.",
    "max"=> array(
        "array"=> ":Attribute жиымының құрамы :max элементтен аспауы керек.",
        "file"=> ":Attribute мәні :max килобайттан көп болмауы керек.",
        "numeric"=> ":Attribute мәні :max мәнінен көп болмауы керек.",
        "string"=> ":Attribute тармағы :max таңбадан ұзын болмауы керек.",
    ),
    "max_digits"=> "The :attribute must not have more than :max digits.",
    "mimes"=> ":Attribute мынадай файл түрі болуы керек: :values.",
    "mimetypes"=> ":Attribute мынадай файл түрі болуы керек: :values.",
    "min"=> array(
        "array"=> ":Attribute кемінде :min элементтен тұруы керек.",
        "file"=> ":Attribute көлемі кемінде :min килобайт болуы керек.",
        "numeric"=> ":Attribute кемінде :min болуы керек.",
        "string"=> ":Attribute кемінде :min таңбадан тұруы керек.",
    ),
    "min_digits"=> "The :attribute must have at least :min digits.",
    "multiple_of"=> ":Attribute :value еселенуі керек",
    "next"=> "Келесі &raquo;",
    "not_in"=> "таңдалған :attribute жарамсыз.",
    "not_regex"=> "таңдалған :attribute форматы жарамсыз.",
    "numeric"=> ":Attribute сан болуы керек.",

//    "password"=> "Қате құпиясөз.",
    "password"=> array(
        "letters"=> ":attribute кемінде бір әріп болуы керек.",
        "mixed"=> ":attribute кемінде бір бас әріпті және бір кіші әріпті қамтуы тиіс.",
        "numbers"=> ":attribute кем дегенде бір сан болуы керек.",
        "symbols"=> ":attribute кемінде бір таңба болуы керек.",
        "uncompromised"=> "Бұл :attribute деректердің ағып кетуі нәтижесінде пайда болды. Басқа :attribute таңдаңыз.",
    ),
    "present"=> ":Attribute болуы керек.",
    "previous"=> "&laquo; Алдыңғы",
    "prohibited"=> ":Attribute өрісіне тыйым салынады.",
    "prohibited_if"=> ":Attribute өрісіне :other :value болған кезде тыйым салынады.",
    "prohibited_unless"=> ":Attribute өрісіне тыйым салынады, егер тек :other :values-де болмаса.",
    "prohibits"=> "The :attribute field prohibits :other from being present.",
    "regex"=> ":Attribute пішімі жарамсыз.",
    "relatable"=> "Бұл :attribute осы ресурсқа байланысты болмауы мүмкін.",
    "required"=> ":Attribute жолы толтырылуы керек.",
    "required_array_keys"=> "The :attribute field must contain entries for: :values.",
    "required_if"=> ":Attribute жолы :other мәні :value болған кезде толтырылуы керек.",
    "required_unless"=> ":Attribute жолы :other мәні :values ішінде болмағанда толтырылуы керек.",
    "required_with"=> ":Attribute жолы :values болғанда толтырылуы керек.",
    "required_with_all"=> ":Attribute жолы :values болғанда толтырылуы керек.",
    "required_without"=> ":Attribute жолы :values болмағанда толтырылуы керек.",
    "required_without_all"=> ":Attribute жолы ешбір :values болмағанда толтырылуы керек.",
    "reset"=> "Құпия сөзіңіз қайта орнатылды!",
    "same"=> ":Attribute және :other сәйкес болуы керек.",
    "sent"=> "Сізге құпия сөзді қайта орнату сілтемесін жібердік!",
    "size"=> array(
        "array"=> ":Attribute жиымы :size элементтен тұруы керек.",
        "file"=> ":Attribute көлемі :size килобайт болуы керек.",
        "numeric"=> ":Attribute көлемі :size болуы керек.",
        "string"=> ":Attribute тармағы :size таңбадан тұруы керек.",
    ),
    "starts_with"=> ":Attribute келесі мәндердің біреуінен басталуы керек: :values",
    "string"=> ":Attribute тармақ болуы керек.",
    "throttle"=> "Кіру әрекеті тым көп болды. :seconds секундтан соң қайталап көріңіз.",
    "throttled"=> "Қайталап көрмей тұрып күте тұрыңыз.",
    "timezone"=> ":Attribute жарамды аймақ болуы керек.",
    "token"=> "Осы құпиясөзді қайта орнату таңбалауышы жарамсыз.",
    "unique"=> ":Attribute бұрын алынған.",
    "uploaded"=> ":Attribute жүктелуі сәтсіз аяқталды.",
    "url"=> ":Attribute пішімі жарамсыз.",
    "user"=> "Бұл электрондық поштамен ешбір пайдаланушыны таба алмадық.",
    "uuid"=> ":Attribute мәні жарамды UUID болуы керек."


    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */


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


);

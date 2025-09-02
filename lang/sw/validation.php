<?php

return [

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


    'accepted' => ' :attribute lazima ikubaliwe.',
    'active_url' => ' :attribute si URL halali.',
    'after' => ' :attribute lazima iwe tarehe baada ya :date.',
    'after_or_equal' => ' :attribute lazima iwe tarehe baada ya au sawa na :date.',
    'alpha' => ' :attribute inaweza kuwa na herufi tu.',
    'alpha_dash' => ' :attribute inaweza kuwa na herufi, namba, alama za kishindo na michirizi tu.',
    'alpha_num' => ' :attribute inaweza kuwa na herufi na namba tu.',
    'array' => ' :attribute lazima iwe orodha.',
    'before' => ' :attribute lazima iwe tarehe kabla ya :date.',
    'before_or_equal' => ' :attribute lazima iwe tarehe kabla ya au sawa na :date.',
    'between' => [
    'numeric' => ' :attribute lazima iwe kati ya :min na :max.',
    'file' => ' :attribute lazima iwe kati ya :min na :max kilobytes.',
    'string' => ' :attribute lazima iwe kati ya :min na :max herufi.',
    'array' => ' :attribute lazima iwe na vitu kati ya :min na :max.',
    ],



    'boolean' => 'Sehemu ya :attribute lazima iwe kweli au uongo.',
    'confirmed' => 'Thibitisho la :attribute halilingani.',
    'date' => ' :attribute si tarehe halali.',
    'date_equals' => ' :attribute lazima iwe tarehe sawa na :date.',
    'date_format' => ' :attribute halifanani na muundo :format.',
    'different' => ' :attribute na :other lazima ziwe tofauti.',
    'digits' => ' :attribute lazima iwe na :digits nambari.',
    'digits_between' => ' :attribute lazima iwe kati ya :min na :max nambari.',
    'dimensions' => ' :attribute ina vipimo vya picha visivyo sahihi.',
    'distinct' => 'Sehemu ya :attribute ina thamani rudufu.',
    'email' => ' :attribute lazima iwe anwani halali ya barua pepe.',
    'ends_with' => ' :attribute lazima iishe na moja ya yafuatayo: :values',
    'exists' => ' :attribute iliyochaguliwa si halali.',
    'file' => ' :attribute lazima iwe faili.',
    'filled' => 'Sehemu ya :attribute lazima iwe na thamani.',
    'gt' => [
    'numeric' => ' :attribute lazima iwe kubwa kuliko :value.',
    'file' => ' :attribute lazima iwe kubwa kuliko :value kilobytes.',
    'string' => ' :attribute lazima iwe kubwa kuliko :value herufi.',
    'array' => ' :attribute lazima iwe na vitu zaidi ya :value.', 
    ],


    'gte' => [
    'numeric' => ' :attribute lazima iwe kubwa au sawa na :value.',
    'file' => ' :attribute lazima iwe kubwa au sawa na :value kilobytes.',
    'string' => ' :attribute lazima iwe kubwa au sawa na :value herufi.',
    'array' => ' :attribute lazima iwe na vitu :value au zaidi.',
 ],
    'image' => ' :attribute lazima iwe picha.',
    'in' => ' :attribute iliyochaguliwa si halali.',
    'in_array' => 'Sehemu ya :attribute haipo katika :other.',
    'integer' => ' :attribute lazima iwe namba nzima.',
    'ip' => ' :attribute lazima iwe anwani halali ya IP.',
    'ipv4' => ' :attribute lazima iwe anwani halali ya IPv4.',
    'ipv6' => ' :attribute lazima iwe anwani halali ya IPv6.',
    'json' => ' :attribute lazima iwe kificho halali cha JSON.',
    'lt' => [
    'numeric' => ' :attribute lazima iwe ndogo kuliko :value.',
    'file' => ' :attribute lazima iwe ndogo kuliko :value kilobytes.',
    'string' => ' :attribute lazima iwe ndogo kuliko :value herufi.',
    'array' => ' :attribute lazima iwe na vitu kidogo kuliko :value.', 
],
    'lte' => [
    'numeric' => ' :attribute lazima iwe ndogo au sawa na :value.',
    'file' => ' :attribute lazima iwe ndogo au sawa na :value kilobytes.',
    'string' => ' :attribute lazima iwe ndogo au sawa na :value herufi.',
    'array' => ' :attribute lazima isiwe na vitu zaidi ya :value.',
 ],
    'max' => [
    'numeric' => ' :attribute haiwezi kuwa kubwa kuliko :max.',
    'file' => ' :attribute haiwezi kuwa kubwa kuliko :max kilobytes.',
    'string' => ' :attribute haiwezi kuwa kubwa kuliko :max herufi.',
    'array' => ' :attribute haiwezi kuwa na vitu zaidi ya :max.',
 ],
    'mimes' => ' :attribute lazima iwe faili la aina: :values.',
    'mimetypes' => ' :attribute lazima iwe faili la aina: :values.',
    'min' => [
    'numeric' => ' :attribute lazima iwe angalau :min.',
    'file' => ' :attribute lazima iwe angalau :min kilobytes.',
    'string' => ' :attribute lazima iwe angalau :min herufi.',
    'array' => ' :attribute lazima iwe na vitu angalau :min.',
 ],
    'not_in' => ' :attribute iliyochaguliwa si halali.',
    'not_regex' => 'Muundo wa :attribute si sahihi.',
    'numeric' => ' :attribute lazima iwe namba.',
    'present' => 'Sehemu ya :attribute lazima iwepo.',
    'regex' => 'Muundo wa :attribute si sahihi.',
    'required' => 'Sehemu ya :attribute inahitajika.',
    'required_if' => 'Sehemu ya :attribute inahitajika wakati :other ni :value.',
    'required_unless' => 'Sehemu ya :attribute inahitajika isipokuwa :other iko katika :values.',
    'required_with' => 'Sehemu ya :attribute inahitajika wakati :values ipo.',
    'required_with_all' => 'Sehemu ya :attribute inahitajika wakati :values zote zipo.',
    'required_without' => 'Sehemu ya :attribute inahitajika wakati :values haipo.',
    'required_without_all' => 'Sehemu ya :attribute inahitajika wakati hakuna ya :values inapatikana.',
    'same' => ' :attribute na :other lazima ziwe sawa.',
    'size' => [
    'numeric' => ' :attribute lazima iwe :size.',
    'file' => ' :attribute lazima iwe :size kilobytes.',
    'string' => ' :attribute lazima iwe :size herufi.',
    'array' => ' :attribute lazima iwe na vitu :size.',
 ],
    'starts_with' => ' :attribute lazima ianze na mojawapo ya yafuatayo: :values',
    'string' => ' :attribute lazima iwe mfuatano wa herufi.',
    'timezone' => ' :attribute lazima iwe eneo halali.',
    'unique' => ' :attribute tayari imetumika.',
    'uploaded' => 'Imeshindikana kupakia :attribute.',
    'url' => 'Muundo wa :attribute si sahihi.',
    'uuid' => ' :attribute lazima iwe UUID halali.',


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

    'custom' => [
    'attribute-name' => [
        'rule-name' => 'ujumbe-binafsi',
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
'attributes' => [],
'custom-messages' => [
    'quantity_not_available' => 'Kiasi cha :qty :unit kinapatikana tu',
    'this_field_is_required' => 'Sehemu hii ni muhimu'
],

];
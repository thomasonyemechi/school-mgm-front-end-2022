<?php

function access_token()
{
    return session()->get('info')['access_token'];
}

function user(){
    return json_decode(json_encode(session()->get('info')['data']['user']));
}

function term()
{
    $t = (array_key_exists('term', session()->get('info')['data'])) ? json_decode(json_encode(session()->get('info')['data']['term'])) : [];
    return $t;
}


function moneyFormat($num)
{
    return '$ '.number_format($num);
}

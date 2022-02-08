<?php

function access_token()
{
    return session()->get('info')['access_token'];
}

function user(){
    return json_decode(json_encode(session()->get('info')['data']['user']));
}

?>

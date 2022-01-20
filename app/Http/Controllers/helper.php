<?php

function access_token()
{
    return session()->get('info')['access_token'];
}


?>

<?php

if (! function_exists('randomKeys')) {
    
    function randomKeys()
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz-_';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < 8; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
}


<?php

if (! function_exists('sanitize_input')) {
    function sanitize_input($input_string) 
    {
        return htmlentities($input_string, ENT_QUOTES, 'UTF-8');
    }
}
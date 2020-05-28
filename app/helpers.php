<?php 

if (! function_exists('formatDate')) {
    function formatDate($date = '', $format = 'm/d/Y'){
        if($date == '' || $date == null)
            return;

        return date($format,strtotime($date));
    }
}

if (! function_exists('formatDateTime')) {
    function formatDateTime($date = '', $format = 'm/d/Y H:i:s'){
        if($date == '' || $date == null)
            return;

        return date($format,strtotime($date));
    }
}
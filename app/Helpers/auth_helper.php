<?php

function hasAccess($area = 'admin')
{
    $session = session();
    $level = $session->get('level');
    
    if ($area === 'admin') {
        return $level <= 2;
    }
    
    if ($area === 'pegawai') {
        return $level <= 3;
    }
    
    return false;
}
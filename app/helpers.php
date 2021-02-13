<?php

function setActiveCategory($cat, $output = 'active')
{
    return request()->category == $cat ? $output : '';
}

function productImage($path)
{
    return ('storage/'.$path != null) && file_exists('storage/'.$path) ? asset('storage/'.$path) : asset('img/not-found.pnh');
}
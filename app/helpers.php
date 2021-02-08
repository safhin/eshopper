<?php

function setActiveCategory($cat, $output = 'active')
{
    return request()->category == $cat ? $output : '';
}
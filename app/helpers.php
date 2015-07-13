<?php

/**
 * Return an active string if the current path matches the provided path.
 *
 * @param $path
 * @param string $active
 * @return string
 */
function set_active($path, $active = 'active')
{
    return Request::is($path) ? $active : '';
}
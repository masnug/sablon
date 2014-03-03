<?php

function theme_asset($path, $secure = null) {
    $path = app('config')->get('sablon::theme_asset') .'/'. $path;
    return app('url')->asset($path, $secure);
}
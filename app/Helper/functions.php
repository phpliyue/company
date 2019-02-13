<?php
/**
 * 功能：检测一个目录是否存在，不存在则创建它
 * @param string    $path      待检测的目录
 * @return boolean
 */
function makeDir($path) {
    if (! file_exists ( $path )) {
        mkdir("$path", 0777, true);
    }
    return is_dir($path) or (makeDir(dirname($path)) and @mkdir($path, 0777));
}
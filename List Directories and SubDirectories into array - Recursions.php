<?php
function file_tree($root) {
    $result = [];
    $str = explode('/', $root);
    $parent = end($str);
    foreach (get_subdir($root) as $directory) {
        $dir = $root . '/' . $directory;
        $result = array_merge($result, file_tree($dir));
    }

    $files = get_subfiles($root);
    $list = array_merge($result, $files);
    
    return [$parent => $list];
}

function get_subdir($root) {
    $result = [];
    foreach (scandir($root) as $child) {
        $dir = $root . '/' . $child;
        if (is_dir($dir) && $child[0] != ".") {
            $result[] = $child;
        }
    }

    return $result;
}
    
function get_subfiles($root) {
    $result = [];
    foreach (scandir($root) as $child) {
        $dir = $root . '/' . $child;
        if (is_file($dir) && $child[0] != ".") {
            $result[] = $child;
        }
    }

    return $result;
}

$directory = "C:/xampp/htdocs";

echo "<pre>" . print_r(json_encode(file_tree($directory), JSON_PRETTY_PRINT), true) . "</pre>";
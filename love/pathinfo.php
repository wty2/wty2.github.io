<?php
function my_path_info($filepath) {
$path_parts = array();
$path_parts ['dirname'] = substr($filepath, 0, strrpos($filepath, '/'));
$path_parts ['basename'] = substr($filepath, strrpos($filepath, '/'));
$path_parts ['extension'] = substr(strrchr($filepath, '.'), 1);
$path_parts ['filename'] = substr($path_parts ['basename'], 0, strrpos($path_parts ['basename'], '.'));
return $path_parts;
}
?>
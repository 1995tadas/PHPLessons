<?php

namespace Core;
class View
{
    public function render($template) {
        $path = __DIR__;
        $path = str_replace('core','',$path);
        include $path.'views/pageParts/header.php';
        include $path.'views/'.$template.'.php';
        include $path.'views/pageParts/footer.php';
    }

    public function renderAdmin($template){
    $path = __DIR__;
    $path = str_replace('core','',$path);
    include $path.'views/admin/header.php';
        include $path.'views/'.$template.'.php';
        include $path.'views/pageParts/footer.php';

    }
}
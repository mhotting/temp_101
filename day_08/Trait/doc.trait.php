<?php

trait Doc {
    public static function doc() {
        $className = static::class;
        $docname = "./classes/" . $className . ".class.txt";
        $str = file_get_contents($docname);
        return ($str);
    }
}

?>
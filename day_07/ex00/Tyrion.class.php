<?php

class Tyrion extends Lannister {
    // Constructor
    function __construct() {
        parent::__construct();
        print( "My name is tyrion\n" );
    }

    // Getter: siwe of object
    public function getSize() {
        return ( "Short" );
    }
}

?>
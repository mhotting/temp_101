<?php

class Joueur {
    // Attributes
    private $_name;
    private $_flotte;
    private $_paneau;

    // Constructor
    public function __construct($name, $nb) {
        $this->_name = $name;
        $this->_flotte = new Flotte($nb);
        //$this->_panneau = new Panneau();
    }

    //toString
    
}

?>
<?php

class Joueur {
    // Attributes
    private $_name;
    private $_flotte;
    private $_panneau;

    // Constructor
    public function __construct($name, $nb, $xinit, $yinit, $dir) {
        $this->_name = $name;
        $this->_flotte = new Flotte($nb, $xinit, $yinit, $dir);
        $this->_panneau = new Panneau($this);
    }

    // Getters
    public function getFlotte() { return ($this->_flotte); }
    public function getName() { return ($this->_name); }
    public function getPanneau() { return ($this->_panneau); }
}

?>
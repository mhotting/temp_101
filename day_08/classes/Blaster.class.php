<?php

class Blaster extends Arme {
    // Constructor
    public function __construct($vaisseau) {
        parent::__construct($vaisseau);
        $this->_degat = 1;
        $this->_portee = 100;
    }

    // Getters
    public function getDegat() { return ($this->_degat); }
    public function getPortee() { return ($this->_portee); }

}


?>
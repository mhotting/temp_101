<?php

class Blaster extends Arme {
    // Constructor
    public function __construct($vaisseau) {
        parent::__construct($vaisseau);
        $this->_degat = 1;
        $this->_portee = 100;
    }

}


?>
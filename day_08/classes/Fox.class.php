<?php

class Fox extends Vaisseau {
    // Constructor
    public function __construct($xinit, $yinit, $dir) {
        parent::__construct($xinit, $yinit, $dir);
        $this->_name = "Fox";
        $this->_vie = 5;
        $this->_bouclier = 2;
        $this->_width = 1;
        $this->_height = 2;
        $this->_vitesse = 1;
    }
}

?>
<?php

abstract class Vaisseau {
    // Attributes
    private $_name;
    private $_arme;
    private $_bouclier;
    private $_vie;
    private $_xpos;
    private $_ypos;
    private $_width;
    private $_height;
    private $_vitesse;

    // Use the weapon
    //abstract public function attaquer();

    // Move x/y axis
    public function moveX($signe) {
        $this->_posX += $signe * $this->_vitesse;
    }
    public function moveY($signe) {
        $this->_posY += $signe * $this->_vitesse;
    }
}

?>
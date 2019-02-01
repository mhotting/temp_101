<?php

abstract class Vaisseau {
    // Attributes
    protected $_name;
    protected $_arme;
    protected $_bouclier;
    protected $_vie;
    protected $_xpos;
    protected $_ypos;
    protected $_width;
    protected $_height;
    protected $_vitesse;
    protected $_dir;

    // Constructor
    public function __construct($xinit, $yinit, $dir) {
        $this->_xpos = $xinit;
        $this->_ypos = $yinit;
        $this->_dir = $dir;
    }
    
    // Use the weapon
    //abstract public function attaquer();

    // Move x/y axis
    public function moveX($signe) {
        $this->_posX += $signe * $this->_vitesse;
    }
    public function moveY($signe) {
        $this->_posY += $signe * $this->_vitesse;
    }

    // Getters
    public function getXpos() { return ($this->_xpos); }
    public function getYpos() { return ($this->_ypos); }
    public function getHeight() { return ($this->_height); }
    public function getWidth() { return ($this->_width); }
}

?>
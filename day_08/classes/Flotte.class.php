<?php

class Flotte implements Iterator {
    // Attributes
    private $_vaisseaux;
    private $_iter;

    // Constructor
    public function __construct($nb, $xinit, $yinit, $dir) {
        $this->_vaisseaux[] = new Fox($xinit, $yinit, $dir);
    }

    // Destructor

    //toString

    // Implementation of the Iterator interface
    public function rewind() {
        $this->_iter = 0;
    }
    public function next() {
        $this->_iter++;
    }
    public function key() {
        return $this->_iter;
    }
    public function current() {
        return $this->_vaisseaux[$this->_iter];
    }
    public function valid() {
        return $this->_iter < sizeof($this->_vaisseaux);
    }
    
}

?>
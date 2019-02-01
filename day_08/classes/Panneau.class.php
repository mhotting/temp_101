<?php

class Panneau {
    // Attributes
    private $_coup;
    private $_joueur;

    // Constructor
    public function __construct($joueur) {
        $this->_coup = 5;
        $this->_joueur = $joueur;
    }

    // Destructor

    //toString
    public function __toString() {
        $str = "";
        $str .= "<h3>Joueur: " . $this->_joueur->getName() . "</h3><br />";
        $str .= "<p>Nombre de coups: " . $this->_coup . "</p><br />";
        $flotte = $this->_joueur->getFlotte();
        foreach ($flotte as $nb => $vaisseau) {
            $str.= "<table>";
            $str .= "<tr><td colspan=\"4\">Vaisseau numéro " . $nb . "</td></tr>";
            $str .= "</table>";
        }
        return ($str);
    }
    
}

?>
<?php

/*
require_once('./Grille.class.php');
require_once('./Obstacle.class.php');
require_once('./Joueur.class.php');
require_once('./Vaisseau.class.php');
require_once('./Fox.class.php');
require_once('./Flotte.class.php');
require_once('./Panneau.class.php');
*/

class Partie {
    // Attributes
    public static $verbose = False;
    private $_joueur1;
    private $_joueur2;
    private $_grille;
    private $_obs;
    private $_current;

    // Constructor
    public function __construct($name1, $name2) {
        $this->_joueur1 = new Joueur($name1, 1, 2, 2, 3);
        $this->_joueur2 = new Joueur($name2, 1, 145, 95, 1);
        $this->_current = 1;
        $this->_grille = new Grille(150, 100);
        $this->_obs = array();
        $this->_obs[] = new Obstacle(30, 30, 10, 20);
        $this->_obs[] = new Obstacle(80, 45, 5, 8);
        $this->_obs[] = new Obstacle(10, 70, 12, 16);
        $this->_obs[] = new Obstacle(120, 60, 15, 30);
        $this->grilleObstacle();
        $this->majVaisseau();
        if (self::$verbose)
            echo("Partie construite.\n");
    }

    // Destructor
    public function __destruct() {
        if (self::$verbose)
            echo("Partie detruite.\n");
    }

    // Set obstacles on the map
    private function grilleObstacle() {
        $grille = $this->_grille->getMatrix();
        foreach ($this->_obs as $obs) {
            for ($i = $obs->getYpos(); $i <= $obs->getYpos() + $obs->getHeight(); $i++) {
                for ($j = $obs->getXpos(); $j <= $obs->getXpos() + $obs->getWidth(); $j++)
                    $grille[$i][$j] = 3;
            }
        }
        $this->_grille->setMatrix($grille);
    }

    // Update ship positions on the map
    public function majVaisseau() {
        $grille = $this->_grille->getMatrix();
        $flotte1 = $this->_joueur1->getFlotte();
        foreach ($flotte1 as $vaisseau) {
            for ($i = $vaisseau->getYpos(); $i <= $vaisseau->getYpos() + $vaisseau->getHeight(); $i++) {
                for ($j = $vaisseau->getXpos(); $j <= $vaisseau->getXpos() + $vaisseau->getWidth(); $j++)
                    $grille[$i][$j] = 1;
            }
        }
        $flotte2 = $this->_joueur2->getFlotte();
        foreach ($flotte2 as $vaisseau) {
            for ($i = $vaisseau->getYpos(); $i <= $vaisseau->getYpos() + $vaisseau->getHeight(); $i++) {
                for ($j = $vaisseau->getXpos(); $j <= $vaisseau->getXpos() + $vaisseau->getWidth(); $j++)
                    $grille[$i][$j] = 2;
            }
        }
        $this->_grille->setMatrix($grille);
    }

    // Getters
    public function getGrille() { return ($this->_grille); }
    public function getCurrent() { return ($this->_current); }
    public function getPanneau() {
        if ($this->_current === 1)
            return ($this->_joueur1->getPanneau());
        else
            return ($this->_joueur2->getPanneau());
    }
}

//$test = new Partie("n", "b");

?>
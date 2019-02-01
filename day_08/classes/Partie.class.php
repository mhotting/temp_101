<?php
//require_once('./Grille.class.php');
//require_once('./Obstacle.class.php');
class Partie {
    // Attributes
    public $verbose = False;
    private $_joueur1;
    private $_joueur2;
    private $_grille;
    private $_obs;

    // Constructor
    public function __construct($name1, $name2) {
        //$this->_joueur1 = new Joueur($name1);
        //$this->_joueur2 = new Joueur($name2);
        $this->_grille = new Grille(150, 100);
        $this->_obs = array();
        $this->_obs[] = new Obstacle(30, 30, 10, 20);
        $this->grilleObstacle();
        if ($this->verbose)
            echo("Partie construite.\n");
    }

    // Destructor
    public function __destruct() {
        if ($this->verbose)
            echo("Partie detruite.\n");
    }

    // Set obstacles on the map
    private function grilleObstacle() {
        $grille = $this->_grille->getMatrix();
        foreach ($this->_obs as $obs) {
            for ($i = $obs->getYpos(); $i < $obs->getYpos() + $obs->getHeight(); $i++) {
                for ($j = $obs->getXpos(); $j < $obs->getXpos() + $obs->getWidth(); $j++)
                    $grille[$i][$j] = 3;
            }
        }
        $this->_grille->setMatrix($grille);
    }

    // Getters
    public function getGrille() { return ($this->_grille); }
}
//$test = new Partie("oim", "oit");
?>
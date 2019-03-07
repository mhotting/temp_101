<?php

if (isset($_SESSION['username'])) {
    ?>
    <nav>
        <div class="left_nav">
            <a href="./index.php"><img src="./public/img/logo.png" alt="logo">CAMAGRU</a>
            <a href="./index.php?action=gallery">Galerie</a>
            <a href="./index.php?action=create">Créer</a>
            <a href="./index.php?action=ownprofile">Page personnelle</a>
            <a href="./index.php?action=logout">Déconnexion</a>
        </div>
        <div class="right_nav">
            <form action="./index.php" method="GET" class="form-inline my-2 my-lg-0">
                <input type="hidden" name="action" value="search">
                <input class="form-control mr-sm-2" type="search" placeholder="Rechercher un membre" aria-label="Search" name="user">
                <button class="btn btn-primary my-2 my-sm-0" type="submit">Ok</button>
            </form>
        </div>
    </nav>
    <?php
} else {
    ?>
    <nav>
        <div class="left_nav">
            <a href="./index.php"><img src="./public/img/logo.png" alt="logo">CAMAGRU</a>
            <a href="./index.php?action=gallery">Galerie</a>
            <a href="./index.php?action=connect">Connexion</a>
            <a href="./index.php?action=suscribe">Inscription</a>
        </div>
        <div class="right_nav">
            <form action="./index.php" method="GET" class="form-inline my-2 my-lg-0">
                <input type="hidden" name="action" value="search">
                <input class="form-control mr-sm-2" type="search" placeholder="Rechercher un membre" aria-label="Search" name="user">
                <button class="btn btn-primary my-2 my-sm-0" type="submit">Ok</button>
            </form>
        </div>
    </nav>
    <?php
}
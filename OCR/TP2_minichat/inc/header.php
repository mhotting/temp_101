    <?php

    if (isset($_SESSION['pseudo'])) {
        ?>
        <header class="header">
            <table>
                <tr>
                    <td><a href="./index.php">Accueil</a></td>
                    <td><a href="./chat.php">Accéder au chat</a></td>
                    <td><a href="./logout.php">Déconnexion</a></td>
                </tr>
            </table>
        </header>
        <?php
    } else {
        ?>
        <header class="header">
            <table>
                <tr>
                    <td><a href="./index.php">Accueil</a></td>
                    <td><a href="./signup.php">Créer un compte</a></td>
                </tr>
            </table>
        </header>
        <?php
    }
    
    ?>
    
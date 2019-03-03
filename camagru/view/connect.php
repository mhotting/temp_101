<fieldset>
    <h1>Connexion</h1>
    <form action="./index.php" method="post">
    <table>
        <?php
            if (isset($_GET['account']) && $_GET['account'] == 'ok') {
                echo('<tr><td colspan="2" class="error">*Compte créé, identifiez-vous pour accéder au chat.</td></tr>');
            } elseif (isset($_GET['error'])) {
                if ($_GET['error'] == 'empty')
                    echo('<tr><td colspan="2" class="error">*Erreur: tous les champs doivent être remplis.</td></tr>');
                elseif ($_GET['error'] == 'exists')
                    echo('<tr><td colspan="2" class="error">*Erreur: le compte n\'existe pas.</td></tr>');
                elseif ($_GET['error'] == 'active')
                    echo('<tr><td colspan="2" class="error">*Erreur: le compte n\'est pas actif.</td></tr>');
                elseif ($_GET['error'] == 'pwd')
                    echo('<tr><td colspan="2" class="error">*Erreur: le mot de passe est erroné.</td></tr>');
                else
                    echo('<tr><td colspan="2" class="error">*Erreur: problème de serveur, retentez plus tard.</td></tr>');
            }
        ?>
        <input type="hidden" name="action" value="connectchecker"
        <tr>
            <td>Votre pseudo:</td>
            <td><input type="text" name="pseudo" placeholder="Saisir pseudo" autofocus></td>
        </tr>
        <tr>
            <td>Votre mot de passe:</td>
            <td><input type="password" name="pwd" placeholder="Saisir mot de passe"></td>
        </tr>
        <tr>
            <td colspan="2"><button class="btn btn-primary my-2 my-sm-0" type="submit">Ok</button></td>
        </tr>
        <tr>
            <td colspan="2" class="password"><a href="#">Mot de passe oublié ?</a></td>
        </tr>
    </table>
    </form>
</fieldset>
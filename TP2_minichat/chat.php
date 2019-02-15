<?php

session_start();
if (!isset($_SESSION['pseudo']) || $_SESSION['pseudo'] == '')
    header('Location: ./index.php?account=connect');
include_once('./inc/connect.php');

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./styles/style.css">
    <title>Mini-chat: Chat</title>
</head>
<body>
    <?php require_once("./inc/header.php"); ?>
    <div class="content">
        <div class="around_chat">
            <div class="chat_window" id="chat_window_id">
                <?php

                $db = ft_connect_db();
                if ($db == Null)
                    header('Location: ./../chat.php?error=db');
                // Extract message from DB
                $query = $db->query('SELECT user.pseudo AS \'pseudo\', message.dateMessage AS \'dateMessage\', message.contenu AS \'contenu\' FROM message INNER JOIN user ON message.idUser = user.idUser ORDER BY dateMessage ASC;');
                $i = 0;
                echo('<table>');
                while ($res = $query->fetch()) {
                    $date = date('d/m H:i', strtotime($res['dateMessage']));
                    if ($i %2 == 0)
                        echo('<tr class="white">');
                    else
                        echo('<tr class="blue">');
                    echo('<td class="info" align="right">' . $date . ' - ' . '<span class="strong">' . $res['pseudo'] . ':</span></td>');
                    echo('<td>' . $res['contenu'] . '</td>');
                    echo('</tr>');
                    $i++;
                }
                echo('</table>');
                ?>
            </div>
        </div>
        
        <div class="chat_post">
            <form action="./controller/chat.php" method="post">
                <table>
                    <tr>
                        <td><textarea name="message" id="message" cols="80" rows="3" autofocus></textarea></td>
                    </tr>
                    <tr>
                        <td align="right"><input type="submit" name="submit" value="Envoyer"></td>
                    </tr>
                </table>
                
            </form>
        </div>
    </div>
</body>
<script>
    var objDiv = document.getElementById("chat_window_id");
    objDiv.scrollTop = objDiv.scrollHeight;
</script>
</html>
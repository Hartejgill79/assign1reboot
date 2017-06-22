<?php ob_start();?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Save Player</title>
    </head>
    <body>
    <?php
    $playerID = $_POST['playerID'];
    $player_name = $_POST['player_name'];
    $birth = $_POST['birth'];
    $birthplace = $_POST['birthplace'];
    $team = $_POST['team'];
    $role = $_POST['role'];
    $battingstyle = $_POST['battingstyle'];
    $bowlingstyle = $_POST['bowlingstyle'];
    //connect to the DB
    $conn = new PDO('mysql:host=localhost;dbname=php','gc200361317','HW6HqS6oQc');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Step 2 - create a SQL command
    if (!empty($playerID))
    {
        $sql = "UPDATE players
                SET name = :player_name, birth = :birth, birthplace = :birthplace, team = :team, role = :role, battingstyle = :battingstyle, bowlingstyle = :bowlingstyle
                WHERE playerID = :playerID";
    }
    else {
        $sql = "INSERT INTO players (player_name, birth, birthplace, team, role, battingstyle, bowlingstyle) 
            VALUES (:player_name, :birth, :birthplace, :team, :role, :battingstyle, :bowlingstyle)";
    }
    //prep the command and bind the parameters to avoid SQL injection
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':player_name', $player_name, PDO::PARAM_STR, 40);
    $cmd->bindParam(':birth', $birth, PDO::PARAM_INT, 40);
    $cmd->bindParam(':birthplace', $birthplace, PDO::PARAM_STR, 40);
    $cmd->bindParam(':team', $team, PDO::PARAM_INT, 40);
    $cmd->bindParam(':role', $role, PDO::PARAM_INT, 40);
    $cmd->bindParam(':battingstyle', $battingstyle, PDO::PARAM_INT, 40);
    $cmd->bindParam(':bowlingstyle', $bowlingstyle, PDO::PARAM_INT, 40);
    if (!empty($playerID))
    {
        $cmd->bindParam(':playerID',$playerID, PDO::PARAM_INT);
    }
    //execute the command
    $cmd->execute();
    //disconnect from the DB
    $conn = null;
    //redirect to another page
    header('location:players.php');
    ?>
    </body>
    </html>
<?php ob_flush(); ?>
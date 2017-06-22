<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Player</title>
</head>
<body>
<?php
if (!empty($_GET['playerID']) ) {
    $playerID = $_GET['playerID'];
    $conn = new PDO('mysql:host=localhost;dbname=php', 'gc200361317', 'HW6HqS6oQc');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // turn on the error handling
    $sql = "DELETE FROM players
                WHERE playerID = :playerID";
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':playerID', $playerID, PDO::PARAM_INT);
    $cmd->execute();
    $conn = null;
}
header('location:players.php');
?>
</body>
</html>
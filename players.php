<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Players</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
</head>
<body>
<main class="container">
    <h1>Players</h1>
    <a href="playerSearch.php">Add a new player</a>
    <?php
    //connect to the DB
    $conn = new PDO('mysql:host=localhost;dbname=php','gc200361317','HW6HqS6oQc');
    //create a SQL command
    $sql = "SELECT * FROM players";
    //prepare and execute the SQL command
    $cmd = $conn->prepare($sql);
    $cmd->execute();
    //store the results in a variable
    $players = $cmd->fetchAll();
    //Step 5 - close the DB connection
    $conn=null;
    //display the results in a table
    echo '<table class="table table-striped table-hover"><tr>
                        <th>player_name</th>
                        <th>birth</th>
                        <th>birthplace</th>
                        <th>team</th>
                        <th>role</th>
                        <th>battingstyle</th>
                        <th>bowlingstyle</th>
                        <th>Edit</th>
                        <th>Change</th></tr>';
    //loop over the $players array to display each player as a new row
    foreach($players as $player)
    {
        echo '<tr><td>'.$player['player_name'].'</td>
                      <td>'.$player['birth'].'</td>
                      <td>'.$player['birthplace'].'</td>
                      <td>'.$player['team'].'</td>
                      <td>'.$player['role'].'</td>
                      <td>'.$player['battingstyle'].'</td>
                      <td>'.$player['bowlingstyle'].'</td>
                      <td><a href="playerSearch.php?playerID='.$player['playerID'].'"class="btn btn-primary"</a>Edit</td>
                      <td><a href="changePlayer.php?playerID='.$player['playerID'].'" class="btn btn-danger confirmation">Change</td></tr>';
    }
    ?>
</main>
</body>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/app.js"></script>
</html>
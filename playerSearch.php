<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Player Search</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
</head>
<body>
<main class="container">
    <h1>Player Search</h1>
    <?php
    //check the URL for an playerID to determine if this is a new or edit player
    if (!empty($_GET['playerID']))
        $playerID = $_GET['playerID'];
    else
        $playerID = null;
    $player_name = null;
    $birth = null;
    $birthplace = null;
    $team = null;
    $role = null;
    $battingstyle = null;
    $bowlingstyle = null;
    //to decide if the player is an edit, we look at the playerID
    if (!empty($playerID))
    {
        //connect to the DB
        $conn = new PDO('mysql:host=localhost;dbname=php','gc200361317','HW6HqS6oQc');
        //create the SQL query
        $sql = "SELECT * FROM players WHERE playerID = :playerID";
        //prepare and execute the SQL
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':playerID', $playerID, PDO::PARAM_INT);
        //update the variables
        $cmd->execute();
        $player = $cmd->fetch();
        $player_name = $player['player_name'];
        $birth = $player['birth'];
        $birthplace = $player['birthplace'];
        $team = $player['team'];
        $role = $player['role'];
        $battingstyle = $player['battingstyle'];
        $bowlingstyle = $player['bowlingstyle'];
        //close the DB connection
        $conn=null;
    }
    ?>
    <form method="post" action="savePlayer.php">
        <fieldset class="form-group">
            <label for="player_name" class="col-sm-1">Name: </label>
            <input name="player_name" id="player_name" required placeholder="Player Name"
                   value="<?php echo $player_name?>"/>
        </fieldset>
        <fieldset class="form-group">
            <label for="birth" class="col-sm-1">BIRTH : </label>
            <input name="birth" id="birth" type="number" min="1900" placeholder="Birth of Player"
                   value="<?php echo $birth ?>"/>
        </fieldset>
        <fieldset class="form-group">
            <label for="birthplace" class="col-sm-1">BIRTHPLACE: </label>
            <input name="birthplace" id="birthplace" required placeholder="Birth Place"
                   value="<?php echo $birthplace?>"/>
        </fieldset>
        <fieldset class="form-group">
            <label for="team" class="col-sm-1">TEAM: </label>
            <input name="team" id="team" required placeholder="Player Team"
                   value="<?php echo $team?>"/>
        </fieldset>
        <fieldset class="form-group">
            <label for="role" class="col-sm-1">ROLE: </label>
            <input name="role" id="role" required placeholder="Role"
                   value="<?php echo $role?>"/>
        </fieldset>
            <fieldset class="form-group">
                <label for="battingstyle" class="col-sm-1">BATTINGSTYLE: </label>
                <input name="battingstyle" id="battingstyle" required placeholder="Batting style"
                       value="<?php echo $battingstyle?>"/>
        </fieldset>
        <fieldset class="form-group">
            <label for="bowlingstyle" class="col-sm-1">BOWLINGSTYLE: </label>
            <input name="bowlingstyle" id="bowlingstyle" required placeholder="Bowling style"
                   value="<?php echo $battingstyle?>"/>
        </fieldset>
        <fieldset class="form-group">
            <label for="genre" class="col-sm-1">Genre: *</label>
            <select name="genre" id="genre">
                <?php
                //connect to the DB
                require('db.php');
                //create a SQL script
                $sql = "SELECT * FROM genres";
                //prepare and execute the SQL script
                $cmd = $conn->prepare($sql);
                $cmd->execute();
                $genres = $cmd->fetchAll();
                //display the results
                foreach($genres as $genre)
                {
                    if ($genrePicked == $genre['genre']){
                        echo '<option selected>'.$genre['genre'].'</option>';
                    }
                    else {
                        echo '<option>'.$genre['genre'].'</option>';
                    }
                }
                //disconnect from the DB
                $conn=null;
                ?>
            </select>
        </fieldset>
        <button>Submit</button>
    </form>
</main>
</body>
<script src="js/bootstrap.min.js"></script>
</html>
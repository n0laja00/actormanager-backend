<!DOCTYPE html>
<?php
try{
    require 'inc/functions.php';
    $conn=opendb();

    $query = "select * from game";
    $query = $conn -> query($query); 
    $game = $query->fetchAll();

}catch(PDOException $e){
    echo"Connection failed: ". $e->getMessage();
};
print_r($game)   
?>

<html>
    <head>
        <h1>Actor Manager</h1>
        <a href="createGame.php/">Create game</a>
    </head>
    <body>
    
    <h1>Games</h1>
        <ol>
            <?php 
                foreach($game as $row) {
                    $gameId=$row["id"];
                    $gameName = $row['name'];
                    $gameDescription = $row['description'];
                    $gameRuleSet = $row['ruleSet'];

                    print("<li>");
                    print($gameName); print("&nbsp; | &nbsp;"); print("<a href='selectGame.php?gameId=$gameId'>Select</a>"); print("&nbsp; | &nbsp;"); print("<a href='deleteGame.php?gameId=$gameId'>Delete</a>")
            ?>
                <ol>
                    <?php 
                        print("<li>");
                        print($gameRuleSet);
                        print("</li>");
                        print("<li>");
                        print($gameDescription);
                        print("</li>");
                    ?>
                </ol>
                <?php 
                print("</li>");
                };
                ?>
        </ol>

    </body>
</html>
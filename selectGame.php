<!DOCTYPE html>
<?php
require 'inc/functions.php';
try{
   
    $conn=opendb();
    $gameId = filter_input(INPUT_GET, 'gameId', FILTER_SANITIZE_NUMBER_INT);
    
    $select = "SELECT * FROM world WHERE gameId=$gameId";

    $select = $conn->query($select);
    $world=$select->fetchAll();

}catch(PDOException $e){
    returnError($e);
};
?>

<html>
    <head>
        <h1>Actor Manager</h1>
    </head>
    <body>
    <h1>Worlds</h1>
        <ol>
            <?php 
                foreach($world as $row) {
                    $worldId=$row["id"];
                    $worldName = $row['name'];
                    $worldDescription = $row['description'];

                    print("<li>");
                    print($worldName); print("&nbsp; | &nbsp;"); print("<a href='selectWorld.php?worldId=$worldId'>Select</a>"); print("&nbsp; | &nbsp;"); print("<a href='deleteWorld.php?worldId=$worldId'>Delete</a>")
            ?>
                <ol>
                    <?php 
                        print("<li>");
                        print($worldDescription);
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
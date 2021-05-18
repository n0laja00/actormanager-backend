<!DOCTYPE html>
<?php 
    require 'inc/functions.php';
    try{
        $conn=opendb();
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $select = "SELECT actor.name as 'name', actor.description as 'description', actor.id as 'id' FROM actor where id=$id";

        $select =$conn->query($select);
        $actor=$select->fetchAll();

        $select1 = "SELECT actorId from stats where actorId = $id";
        $select1 =$conn->query($select1);
        $stat=$select1->fetchAll();

    } catch(PDOException $e) {
        returnError($e);
    }
    
?>

<html>
 <head>
    <h1>Actor Manager</h1>
 </head>
 <body>
    <h1>Actors</h1>
    <ol>
            <?php 
            
                foreach($actor as $row) {
                    $id=$row["id"];
                    $name = $row['name'];
                    $description = $row['description'];

                    print("<li>");
                    print($name); print("&nbsp; | &nbsp;"); if(sizeof($stat)>0){print("<a href='selectStats.php?id=$id'>Select Statblock</a>"); }else{print("This character has no statblock!");}; print("&nbsp; | &nbsp;"); print("<a href='deleteStats.php?id=$id'>Delete</a>")
                    
            ?>
                <ol>
                    <?php 
                        print("<li>");
                        print($description);
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
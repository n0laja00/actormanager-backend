<!DOCTYPE html>
<?php 
    require 'inc/functions.php';
    try{
        $conn=opendb();
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $select = "SELECT statBlockVMId AS 'VMId', statBlockDNDId AS 'DNDId', actorId AS 'id', actor.name AS 'name' FROM actor INNER JOIN stats where id=$id";

        $select =$conn->query($select);
        $stats=$select->fetchAll();

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
            
                foreach($stats as $row) {
                    $id=$row["id"];
                    $name = $row['name'];
                    $VMId = $row['VMId'];
                    $DNDId = $row['DNDId'];

                    print("<li>");
                    print($name); print("&nbsp; | &nbsp;"); if(strlen($VMId)>0){print("<a href='selectVMStats.php?VMId=$VMId'>See Vampire: The Masquerade Statblock</a>"); }else{print("This character has no forbidden statblock!");}; print("&nbsp; | &nbsp;"); 
                    if(strlen($DNDId)>0){print("<a href='selectStats.php?id=$id'>Select Statblock</a>"); }else{print("This character has no statblock!");};
                    print("</li>");
                };
                
                ?>
        </ol>
 </body>
</html>
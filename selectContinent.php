<!DOCTYPE html>
<?php 
    require 'inc/functions.php';

    try{
        $conn=opendb();
        $continentId = filter_input(INPUT_GET, 'continentId', FILTER_SANITIZE_NUMBER_INT);

        $select = "SELECT nation.name as 'name', nation.description as 'description', nation.id as 'id' FROM nation INNER JOIN continentNation on nation.id = continentNation.nationId INNER JOIN continent on continent.id = continentNation.continentId where continentNation.continentId = $continentId";

        $select =$conn->query($select);
        $nation=$select->fetchAll();

    } catch(PDOException $e) {
        returnError($e);
    }
    
?>

<html>
 <head>
    <h1>Actor Manager</h1>
 </head>
 <body>
    <h1>Nations</h1>
    <ol>
            <?php 
                foreach($nation as $row) {
                    $nationId=$row["id"];
                    $nationName = $row['name'];
                    $nationDescription = $row['description'];

                    print("<li>");
                    print($nationName); print("&nbsp; | &nbsp;"); print("<a href='selectNation.php?nationId=$nationId'>Select</a>"); print("&nbsp; | &nbsp;"); print("<a href='deleteNation.php?nationId=$nationId'>Delete</a>")
            ?>
                <ol>
                    <?php 
                        print("<li>");
                        print($nationDescription);
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
<!DOCTYPE html>
<?php 
    require 'inc/functions.php';
    try{
        $conn=opendb();
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $select = $select = "SELECT organisation.name as 'name', organisation.description as 'description', organisation.id as 'id' FROM organisation INNER JOIN cityOrganisation on organisation.id = cityOrganisation.organisationId INNER JOIN city on city.id = cityorganisation.cityId where cityId=$id";

        $select =$conn->query($select);
        $oraganisation=$select->fetchAll();

    } catch(PDOException $e) {
        returnError($e);
    }
    
?>

<html>
 <head>
    <h1>Actor Manager</h1>
 </head>
 <body>
    <h1>Organisations</h1>
    <ol>
            <?php 
                foreach($oraganisation as $row) {
                    $id=$row["id"];
                    $name = $row['name'];
                    $description = $row['description'];

                    print("<li>");
                    print($name); print("&nbsp; | &nbsp;"); print("<a href='selectOrganisation.php?id=$id'>Select</a>"); print("&nbsp; | &nbsp;"); print("<a href='deleteOrganisation.php?id=$id'>Delete</a>")
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
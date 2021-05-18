<!DOCTYPE html>
<?php 
    require 'inc/functions.php';
    try{
        $conn=opendb();
        $nationId = filter_input(INPUT_GET, 'nationId', FILTER_SANITIZE_NUMBER_INT);
        $select = "SELECT * FROM city where nationId = $nationId";

        $select =$conn->query($select);
        $city=$select->fetchAll();

    } catch(PDOException $e) {
        returnError($e);
    }
    
?>

<html>
 <head>
    <h1>Actor Manager</h1>
 </head>
 <body>
    <h1>Cities</h1>
    <ol>
            <?php 
                foreach($city as $row) {
                    $id=$row["id"];
                    $name = $row['name'];
                    $description = $row['description'];

                    print("<li>");
                    print($name); print("&nbsp; | &nbsp;"); print("<a href='selectCity.php?id=$id'>Select</a>"); print("&nbsp; | &nbsp;"); print("<a href='deleteCity.php?id=$id'>Delete</a>")
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
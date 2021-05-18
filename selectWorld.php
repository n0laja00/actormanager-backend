<!DOCTYPE html>
<?php 
    require 'inc/functions.php';
    try{
        $conn=opendb();
        $worldId=filter_input(INPUT_GET, 'worldId', FILTER_SANITIZE_NUMBER_INT);

        $select = "SELECT * FROM continent WHERE worldId=$worldId";

        $select = $conn->query($select);
        $continent=$select->fetchAll();

    }catch(PDOException $e) {
        returnError($e);
    };
?>

<html>
    <head>
        <h1>Actor Manager</h1>
    </head>
    <body>
        <h1>Continents</h1>
        <ol>
            <?php 
                foreach($continent as $row) {
                    $continentId=$row['id'];
                    $continentName=$row['name'];
                    $continentDescription=$row['description'];
                    print("<li>");
                    print($continentName); print("&nbsp;|&nbsp;"); print("<a href='selectContinent.php?continentId=$continentId'>Select</a>"); print("&nbsp; | &nbsp;"); print("<a href='deleteContinent.php?continentId=$continentId'>Delete</a>")
            ?>
                <ol>
                    <?php 
                        print("<li>");
                        print($continentDescription);
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

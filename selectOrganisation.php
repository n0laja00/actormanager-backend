<!DOCTYPE html>
<?php 
    require 'inc/functions.php';
    try{
        $conn=opendb();
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $select = "SELECT actor.name as 'name', power.name as 'powerName', power.description as 'description', power.powerLevel as 'swayPoints', powerpyramid.superior as 'superiorId', power.id as 'powerId', actor.Id as 'id' FROM actor INNER JOIN powerpyramid on actor.id = actorId INNER JOIN power on power.id = powerId where organisationId = $id";

        $select =$conn->query($select);
        $actor=$select->fetchAll();

        $select1 = "SELECT actorId AS 'subjectId', powerpyramid.superior AS 'superiorId' FROM actor INNER JOIN powerpyramid ON actor.id = powerpyramid.actorId where powerpyramid.superior IS NOT NULL";
        $select1 =$conn->query($select1);
        $superior=$select1->fetchAll();
        
        $array = [];

        foreach($superior as $row) {
            $subId = $row['subjectId'];
            $supId = $row['superiorId'];
            $select2 = "SELECT actor.name AS 'name', actor.id as 'id' from actor INNER JOIN powerpyramid on actor.id=powerpyramid.actorId where actor.id = $supId";
            $select2 =$conn->query($select2);
            $supArr=$select2->fetchAll();
            array_push($array,$supArr);
            json_encode($array);
        }

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
                arsort($actor);
                foreach($actor as $row) {
                    $id=$row["id"];
                    $powerId = $row['powerId'];
                    $name = $row['name'];
                    $powerName = $row['powerName'];
                    $swayPoints = $row['swayPoints'];
                    $description = $row['description'];
                    $superiorId = $row['superiorId'];

                    print("<li>");
                    print($name); print("&nbsp; | &nbsp;"); print("<a href='selectActor.php?id=$id'>Select</a>"); print("&nbsp; | &nbsp;"); print("<a href='deleteActor.php?id=$id'>Delete</a>");
            ?>
            <ol>
                <?php 
                    print("<li>");
                    print($powerName.": ".$description);
                    print("</li>");
                    print("<li>");
                    print("Sway Points".": ".$swayPoints);
                    print("</li>");
                    if(strlen($superiorId) > 0) {
                        foreach($supArr as $row) {
                            $name2=$row['name'];
                            $id2=$row['id'];
                            if ($superiorId = $id2){
                                print("<li>");
                                print("Superior: ".$name2); print("&nbsp; | &nbsp;"); print("<a href='selectActor.php?id=$id2'>Select</a>"); print("&nbsp; | &nbsp;"); print("<a href='deleteActor.php?id=$id2'>Delete</a>");
                                print("</li>");
                            }
                        };
                    };
                ?>
            </ol>
            <?php 
            print("</li>");
            };
            ?>
        </ol>
 </body>
</html>
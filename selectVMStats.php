<!DOCTYPE html>
<?php 
    require 'inc/functions.php';
    try{
        $conn=opendb();
        $id = filter_input(INPUT_GET, 'VMId', FILTER_SANITIZE_NUMBER_INT);
        $select = "SELECT * FROM statblockvm INNER JOIN charInfoVM on statblockvm.charInfoVMId = charinfovm.id INNER JOIN counterVM on counterVMId = counterVM.id INNER JOIN expvm on expVMId = expvm.id where statblockvm.id=$id";

        $select =$conn->query($select);
        $stats=$select->fetchAll();

        $select1 = "SELECT skillvm.name as 'skillname', statblockvmskill.dots as 'dots', statblockvmskill.speciality as 'speciality' FROM statblockvm INNER JOIN statblockvmskill on statblockvm.id = statblockvmskill.statBlockVMId INNER JOIN skillvm on statblockvmskill.skillVMId = skillvm.id where statblockvmskill.statBlockVMId = statblockvm.id";

        $select1 =$conn->query($select1);
        $skills=$select1->fetchAll();

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
                print_r($stats);
                print("<br>");
                print_r($skills);
                foreach($stats as $row) {
                    $name = $row['5'];
                    $name1 = $row['name'];
                    $hunger = $row['hun'];
                    $humanity = $row['hum'];
                    $ambition = $row['ambi'];
                    $desire = $row['des'];
                    $sire = $row['sire'];
                    $generationNum=$row['generationNum'];
                    $hp = $row['hp'];
                    $wp = $row['wp'];
                    $bloPo = $row['bloPo'];
                    $conc = $row['conc'];
                    $clanId=$row['clanVMId'];
                    $expSpent = $row['spent'];
                    $expTotal = $row['total'];
                   
                    print("<div>");
                                print("Name: ".$name);
                            print("&nbsp;|&nbsp;");
                                print("Concept: ".$conc);
                            print("&nbsp;|&nbsp;");
                                print("Predator: "."insert pred here");
                            print("&nbsp;|&nbsp;");
                                print("Clan: ".$clanId);
                            print("&nbsp;|&nbsp;");
                                print("Generation: ".$generationNum." th. ".$name1);
                    print("</div>");

                    print("<div>");
                            print("Ambition: ".$ambition);
                            print("&nbsp;|&nbsp;");
                                print("Desire: ".$desire);
                            print("&nbsp;|&nbsp;");
                                print("Predator: "."insert pred here");
                            print("&nbsp;|&nbsp;");
                                print("Sire: ".$sire);
                    print("</div>");

                    print("<div>");
                    print("<h1>"); print("Combat"); print("</h1>");
                        print("<div>");
                        print("<p>"); print("hit points: ".$hp); print("</p>");
                        print("<p>"); print("willpower: ".$wp); print("</p>");
                        print("</div>");
                    print("</div>");
                    print("<h1>"); print("exp"); print("</h1>");
                        print("<div>");
                        print("<p>"); print("Total: ".$expTotal); print("</p>");
                        print("<p>"); print("Spent: ".$expSpent); print("</p>");
                        print("</div>");
                    print("</div>");
                    print("</div>");
                    print("<div>");
                        print("<h1>"); print("Skills"); print("</h1>");
                        for ($row = 0; $row < count($skills); $row++) {
                            print("<div>");
                            for ($col = 0; $col < 3; $col++) { 
                                echo " ".$skills[$row][$col];
                            };
                            print("</div>");
                          };
                        print("</div>");
                    print("</div>");
                };
                
                    
                
                
            ?>
        </ol>
 </body>
</html>
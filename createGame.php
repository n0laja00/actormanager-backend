<!DOCTYPE html>
<?php

    
?>

<html>
    <head>
        <h1>Actor Manager</h1>
    </head>
    <body>
    <h1>Make a game</h1>
        <form action="/actormanager/saveGame.php" method="post">
            <div>
                <div>
                    <label>Name</label>
                    <input id="name" maxlength="255" required name="name" type="text" />
                </div>
                <div>
                    <label>Rule Set</label>
                    <input id="ruleSet" maxlength="255" required name="ruleSet" type="text" />
                </div>
                <div>
                    <label>Description</label>
                    <input id="description" maxlength="255" required name="description" type="text" />
                </div>
            </div>
            <input type="submit" value="Save Game" />
        </form>
    </body>
</html>



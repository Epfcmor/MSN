<?php
session_start();
require_once('DBManager.php');
$db = new DBManager();

require_once('SessionManager');
$auth = new SessionManager($db, $_SESSION);

require_once('UserManager.php');
$UM = new UserManager($db);
$users = $UM->getUsersList();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Members</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="title">Other Members</div>
        <div class="menu">
            <a href="profile.php">Home</a>
            <a href="members.php">Members</a>
            <a href="friends.php">Friends</a>
            <a href="messages.php">Messages</a>
            <a href="edit_profile.php">Edit Profile</a>
            <a href="logout.php">Log Out</a>
        </div>
        <div class="main">
            <ul>
                <?php
                foreach($users as $user) {
                    echo "<li>".$user->getPseudo()."</li>";
                }
                ?>
            </ul>
        </div>
    </body>
</html>
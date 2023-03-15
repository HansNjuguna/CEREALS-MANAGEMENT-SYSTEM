<?php
// include database connection
include_once '../dbh.php';

if (isset($_POST['id'])) {
    $uid = $_POST['id'];
    $sql = "SELECT * FROM messages WHERE uid = '$uid'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    while ($row = mysqli_fetch_assoc($result)) {
        $attachement = $row['attachments'];
        $message = $row['message'];
        $to_id = $row['to_id'];
        if ($to_id == $uid) {
            echo '<div class="self">
                            <p>' . $message . '</p>
                            ';
            if ($attachement != '') {
                echo '<a href="' . $attachement . '" target="_blank">' . $attachement . '</a>';
            }
            echo '</div>';
        } elseif ($to_id == 101) {
            echo '<div class="other">
                            <p>' . $message .
                '</p>
                            ';
            if ($attachement != '') {
                echo '<a href="' . $attachement . '" target="_blank">' . $attachement . '</a>';
            }
            echo '</div>';
        }
    }
}

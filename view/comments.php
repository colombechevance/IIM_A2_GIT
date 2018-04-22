<?php

function setComments($db)
{
    if (isset($_POST['commentSubmit'])) {
        $id = $_POST['id'];
        $date = $_POST['date'];
        $message = $_POST['message'];
        $sql = "INSERT INTO comments(id, date, message) VALUES ('$id', '$date', '$message')";
        $result = $db->query($sql);
    }
}
function getComments($db)
{
    $sql = "SELECT * FROM comments";
    $result = $db->query($sql);
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<div class='comment-box'><p><b>";
        echo $row['id'] . "<br>";
        echo "</b>";
        echo "<i>";
        echo $row['date'] . "<br><br>";
        echo "</i>";
        echo $row['message'];
        echo "</p>
                <form class='delete-form actionicon' method='POST' action='" . deleteComments($db) . "'>
                    <input type='hidden' name='cid' value='" . $row['id'] . "'>
                    <button class='btn btn-danger' name='commentDelete' type='submit'>Supprimer</button>
                </form>                                             
                <form class='edit-form actionicon' method='POST' action='editcomments.php'>
                    <input type='hidden' name='cid' value='" . $row['id'] . "'>
                    <input type='hidden' name='date' value='" . $row['date'] . "'>
                    <input type='hidden' name='message' value='" . $row['message'] . "'>
                    <button class='btn btn-primary'>Éditer</button>
                </form>
              </div>";
    }
}

function deleteComments($db)
{
    if (isset($_POST['commentDelete'])) {
        $cid = $_POST['cid'];
        $sql = "DELETE FROM comments WHERE id='$cid'";
        $result = $db->query($sql);
        header("Location: dashboard.php");
    }
}
function editComments($db)
{
    if (isset($_POST['commentSubmit'])) {
        $cid = $_POST['id'];
        $date = $_POST['date'];
        $message = $_POST['message'];
        $sql = "UPDATE comments SET message='$message' WHERE cid='$cid'";
        $result = $db->query($sql);
        header("Location: dashboard.php");
    }
}

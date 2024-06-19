<?php

/*******w******** 
    
    Name: Jiale Cao
    Date: June 18
    Description: POST page for the blog

 ****************/
require('authenticate.php');
require('connect.php');



//create a post 
if (isset($_POST['command']) && $_POST['command'] == 'Create') {

    if (strlen($_POST['title']) < 1 || strlen($_POST['content']) < 1) {
        header("Location: process_post.php");
        exit();
    }

    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $query = "INSERT INTO post (title, content) VALUES ('$title', '$content')";
    $result = $db->query($query);
    if ($result) {
        header('Location: index.php');
    } else {
        echo "Error: " . $result;
    }
}

//update the post 
if (isset($_POST['command']) && $_POST['command'] == 'Update') {

    if (strlen($_POST['title']) < 1 || strlen($_POST['content']) < 1) {
        header("Location: process_post.php");
        exit();
    }
    
    if (!isset($_POST['id']) || !filter_var($_POST['id'], FILTER_VALIDATE_INT)) {
        header("Location: index.php");
        exit;
    }

    $id = $_POST['id'];

    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // update the post

    $sql = "UPDATE post SET title = '$title', content = '$content' WHERE id = $id";
    $result = $db->query($sql);


    header('Location: index.php');
}

//delete the post 
if (isset($_POST['command']) && $_POST['command'] == 'Delete') {
    if (!isset($_POST['id']) || !filter_var($_POST['id'], FILTER_VALIDATE_INT)) {
        header("Location: index.php");
        exit;
    }

    $id = $_POST['id'];
    $sql = "DELETE FROM post WHERE id = $id";
    $result = $db->query($sql);

    header('Location: index.php');
}






?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>My Blog Post!</title>
</head>

<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">Stung Eye - New Post</a></h1>
        </div>
        <ul id="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="post.php" class="active">New Post</a></li>
        </ul>
        <div id="all_blogs">
            <form action="post.php" method="post">
                <fieldset>
                    <legend>New Blog Post</legend>
                    <p>
                        <label for="title">Title</label>
                        <input name="title" id="title" />
                    </p>
                    <p>
                        <label for="content">Content</label>
                        <textarea name="content" id="content"></textarea>
                    </p>
                    <p>
                        <input type="submit" name="command" value="Create" />
                    </p>
                </fieldset>
            </form>
        </div>
        <div id="footer">
            Copywrong 2024 - No Rights Reserved
        </div>
    </div>
</body>

</html>
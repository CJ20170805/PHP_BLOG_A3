<?php

/*******w******** 
    
    Name: Jiale Cao
    Date: June 18
    Description: Index Page

 ****************/

require('connect.php');

if (!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

$query = "SELECT * FROM post WHERE id = $id";
$result = $db->query($query);

$post = $result->fetch();
$title = $post['title'];
$created_at = $post['created_at'];
$content = $post['content'];



?>
<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Post detail</title>
</head>

<body>
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">Stung Eye - test!</a></h1>
        </div>
        <ul id="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="post.php">New Post</a></li>
        </ul>
        <div id="all_blogs">
            <div class="blog_post">
                <h2><?php echo htmlspecialchars($title) ?></h2>
                <p>
                    <small>
                    <?php echo htmlspecialchars($created_at) ?> -
                        <a href="edit.php?id=<?= $id ?>">edit</a>
                    </small>
                </p>
                <div class="blog_content">
                <?php echo htmlspecialchars($content) ?></div>
            </div>
        </div>
        <div id="footer">
            Copywrong 2024 - No Rights Reserved
        </div>
    </div>
</body>

</html>
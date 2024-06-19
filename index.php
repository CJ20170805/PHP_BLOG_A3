<?php

/*******w******** 
    
    Name: Jiale Cao
    Date: June 18
    Description: Index Page

 ****************/

require('connect.php');
$query = "SELECT * FROM post ORDER BY id DESC LIMIT 5";
$newest_post = $db->query($query);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Welcome to my Blog!</title>
</head>

<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">Stung Eye - Index</a></h1>
        </div>
        <ul id="menu">
            <li><a href="index.php" class="active">Home</a></li>
            <li><a href="post.php">New Post</a></li>
        </ul>
        <div id="all_blogs">

            <?php foreach ($newest_post as $post) : ?>
                <div class="blog_post">
                    <h2><a href="show.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a></h2>
                    <p>
                        <small>
                        <!-- All dates should be formatted: "MonthName dd, yyyy, hh:mm am/pm" -->
                        <?= date('F j, Y, g:i a', strtotime($post['created_at'])) ?> -
                            <a href="edit.php?id=<?= $post['id'] ?>">edit</a>
                        </small>
                    </p>
                    <div class="blog_content">
                        <?php
                        $content = $post['content'];
                        if (strlen($content) > 200) {
                            $content = substr($content, 0, 200) . '...';
                        }
                        echo $content;
                        ?>

                        <?php if (strlen($post['content']) > 200) : ?>
                            <a href="show.php?id=<?= $post['id'] ?>">Read Full Post</a>
                        <?php endif; ?>

                    </div>
                <?php endforeach; ?>

                </div>
                <div id="footer">
                    Copywrong 2024 - No Rights Reserved
                </div>
        </div>
</body>

</html>
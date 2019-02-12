<?php

    include 'layout/header.php';

    echo "<h1>Posts</h1>";
    foreach($posts as $post)
        echo $post['title'] . "<br/>";

    include 'layout/footer.php';


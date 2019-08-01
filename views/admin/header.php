<html>
<head>

    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" type="text/css" href="http://141.136.44.119/mvc/resources/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="http://141.136.44.119/mvc/resources/css/style.css">
    <script src="http://141.136.44.119/mvc/resources/js/jquery.js"></script>
    <script src="http://141.136.44.119/mvc/resources/js/functions.js"></script>
</head>
<body>
<header>
    <a href="<?php echo url("post/") ?>">
        <img src="https://hip-books.com/wp-content/uploads/2016/12/SafeOrgIcon-O-Blog-300x300.png" alt="Something really nice">
    </a>
    <ul>
        <li>
            <a href="<?php echo url('admin/posts')?>">Posts</a>
        </li>
        <li>
            <a href="<?php echo url('admin/categories')?>">Categories</a>
        </li>
    </ul>
</header>
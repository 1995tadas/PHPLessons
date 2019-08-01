<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Blog site</title>
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
            <a href="<?php echo url('/')?>">Home</a>
        </li>
        <?php if($this->user): ?>
        <li>
            <a href="<?php echo url('search')?>">Search</a>
        </li>
        <li>
            <a href="<?php echo url('account/logout')?>">Log out</a>
        </li>
        <li>
            <a href="<?php echo url('post/create/')?>">Create post</a>
        </li>
        <li>
            <a href="<?php echo url('category/create/')?>">Category</a>
        </li>

        <?php else: ?>
        <li>
            <a href="<?php echo url('account/login')?>">Login</a>
        </li>
        <li>
            <a href="<?php echo url('account/registration/')?>">Registration</a>
        </li>

        <?php endif; ?>
        <?php foreach ($this->categories as $category): ?>
            <li>
                <a href="<?php echo  url('category/show',$category->slug)?>"><?php echo $category->name; ?></a>
            </li>
        <?php endforeach; ?>

    </ul>
</header>

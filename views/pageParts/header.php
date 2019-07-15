<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Blog site</title>
    <link rel="stylesheet" type="text/css" href="http://141.136.44.119/mvc/resources/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="http://141.136.44.119/mvc/resources/css/style.css">
</head>
<body>
<header>
    <a href="<?php echo url("post/") ?>">
        <img src="https://hip-books.com/wp-content/uploads/2016/12/SafeOrgIcon-O-Blog-300x300.png" alt="Something really nice">
    </a>
    <ul>
        <?php if($this->user): ?>
        <li>
            <a href="<?php echo url('account/logout')?>">Log out</a>
        </li>
        <li>
            <a href="<?php echo url('post/create/')?>">Create post</a>
        </li>
        <?php else: ?>
        <li>
            <a href="<?php echo url('account/login')?>">Login</a>
        </li>
            <li>
                <a href="<?php echo url('account/registration/')?>">Registration</a>
            </li>
        <?php endif; ?>
        <li>
            <a href="<?php echo url('/')?>">Home</a>
        </li>
    </ul>
</header>

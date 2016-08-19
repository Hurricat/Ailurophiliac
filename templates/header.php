<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ChuChu Bot Reference">
    <meta property="og:title" content="Ailurophiliac">
    <meta property="og:description" content="ChuChu Bot Reference">
    <meta property="og:url" content="http://ailurophiliac.com">
    <meta property="og:image" content="http://ailurophiliac.com/images/richpreview.png">
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/custom.css" rel="stylesheet">
    <?php if (isset($title)): ?>
        <title>Ailurophiliac - <?= htmlspecialchars($title) ?></title>
    <?php else: ?>
        <title>Ailurophiliac</title>
    <?php endif ?>

    <body>
        <nav class="navbar navbar-default"></nav>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainNav">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/announcements">Ailurophiliac</a>
                </div>
                <div class="collapse navbar-collapse" id="mainNav">
                    <ul class="nav navbar-nav">
                        <li><a href="/announcements">Home</a></li>
                        <li><a href="/about">About</a></li>
                        <li><a href="/projects">Projects</a></li>
                        <li><a href="/contact">Contact</a></li>
                        <li><a href="/links">Links</a></li>
                        <?php
                            if ($_SESSION['id']) {
                                echo '<li><a href="/admin">Admin Home</a></li>';
                                echo '<li><a href="/admin/tags">Tags</a></li>';
                                echo '<li><a href="/admin/newpost">New Post</a></li>';
                                echo '<li><a href="/admin/logout">Log Out</a></li>';
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <?php if (isset($title)): ?>
                        <h1><?= htmlspecialchars($title) ?></h1>
                    <?php endif ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?php echo $title; ?></title>
        <link href="/styles/bootstrap.css" rel="stylesheet">
        <link href="/styles/admin.css" rel="stylesheet">
        <link href="/styles/font-awesome.css" rel="stylesheet">
        <script src="/scripts/jquery.js"></script>
        <script src="/scripts/form.js"></script>
        <script src="/scripts/popper.js"></script>
        <script src="/scripts/bootstrap.js"></script>
        <script src="/scripts/core.js"></script>
    </head>
    <body class="fixed-nav sticky-footer bg-dark">
        <?php if ($this->route['action'] != 'login'): ?>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
                <a class="navbar-brand" href="/admin/posts">Admin Panel</a>
                 <a class="navbar-brand" style="text-align: center;" href="/">View site</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
                       
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/posts">
                            <i class="fa fa-fw fa-list"></i>
                            <span class="nav-link-text">Posts</span>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link" href="/admin/post/add">
                            <i class="fa fa-fw fa-plus"></i>
                            <span class="nav-link-text">Add post</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/categories">
                            <i class="fa fa-fw fa-list"></i>
                            <span class="nav-link-text">Categories</span>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link" href="/admin/category/add">
                            <i class="fa fa-fw fa-plus"></i>
                            <span class="nav-link-text">Add category</span>
                            </a>
                        </li>                        
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/logout">
                            <i class="fa fa-fw fa-sign-out"></i>
                            <span class="nav-link-text">Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        <?php endif; ?>
        <?php echo $content; ?>
        <?php if ($this->route['action'] != 'login'): ?>
           
        <?php endif; ?>
    </body>
</html>
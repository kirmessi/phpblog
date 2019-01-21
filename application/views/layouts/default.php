<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?php echo $title; ?></title>
        <link href="/styles/bootstrap.css" rel="stylesheet">
        <link href="/styles/main.css" rel="stylesheet">
        <link href="/styles/font-awesome.css" rel="stylesheet">
        <script src="/scripts/jquery.js"></script>
        <script src="/scripts/form.js"></script>
        <script src="/scripts/popper.js"></script>
        <script src="/scripts/bootstrap.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="/">PHP-Blog</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/contact">Contacts</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <?php echo $content; ?>
        <hr>
     
    </body>
</html>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>{% block title %}Home{% endblock %}</title>
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
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Sign in</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/register">Register</a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </nav>
      {% block sliderimage %}<header class="masthead" style="background-image: url('/images/home-bg.jpg')">{% endblock %}
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h1>{% block slidertitle %}PHP Framework{% endblock %}</h1>
                    <span class="subheading">{% block subslidertitle %}i'm a simple blog on PHP-OOP-MVC{% endblock %}</span>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
        {% block content %}
                {% for val in list %}
                    <div class="post-preview">
                        <a href="/post/{{val.slug}}">
                            <h2 class="post-title">{{val.name}}</h2>
                            <h5 class="post-subtitle">{{val.description}}</h5>
                        </a>
                       <div class="row">
                        <div class="col-6">Создано: {{val.date}}</div>
                        <div class="col-6"><a href="/category/{{val.cat_slug}}">{{val.cat_name}}</a></div>
                        </div>
                    </div>
                    <hr>
                  {% endfor %}
        {% endblock %}          
        </div>
    </div>
</div>
        <hr>
     
    </body>
</html>



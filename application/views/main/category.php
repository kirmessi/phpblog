
{% extends "index.php" %}
{% block title %}{% for val in category %}{{val.title}}{% endfor %}{% endblock %}
{% block sliderimage %}<header class="masthead" style="background-image: url('/images/home-bg.jpg')">{% endblock %}
{% block slidertitle %}{% for val in category %}{{val.title}}{% endfor %}{% endblock %} 
{% block subslidertitle %}{% for val in category %}{{val.description}}{% endfor %}{% endblock %}
 {% block content %}
    {% for val in list %}
    <div class="post-preview">
        <a href="/post/{{val.slug}}">
        <h2 class="post-title">{{val.title}}</h2>
        <h5 class="post-subtitle">{{val.description}}</h5>
        </a>
        <div class="row">
        <div class="col-6">Created at: {{val.date}}</div>
      
        </div>                    
    </div>
    <hr>
    {% endfor %}              
 {% endblock %}          
  

{% extends "index.php" %}
{% block title %}Dashboard{% endblock %}
{% block sliderimage %}<header class="masthead" style="background-image: url('/images/contact-bg.jpg')">{% endblock %}
                  {% block slidertitle %}
                  	{% for val in list %}
                  Welcome, {{val.username}} 
                  	{% endfor %} 
                  {% endblock %} 
                  {% block subslidertitle %}Join to us!{% endblock %}
            {% block content %}
         <div class="row">
                 <ul><li><a href="/dashboard/add/">Добавить пост</a></li></ul> 
                </div>
            {% endblock %}
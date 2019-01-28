{% extends "index.php" %}
{% block title %}{{data.name}}{% endblock %}
{% block sliderimage %}<header class="masthead" style="background-image: url('/materials/{{data.id}}.jpg')">{% endblock %}
{% block slidertitle %}{{data.name}}{% endblock %} 
{% block subslidertitle %}{{data.description}}{% endblock %}
{% block content %}
           {{data.text}}
{% endblock %}  
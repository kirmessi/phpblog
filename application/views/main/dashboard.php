
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
        <div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-12">
            <div class="card-header">Posts</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                       
                            <table class="table">
                                <tr>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                {% for post in posts %}
                                    <tr>
                                        <td>{{post.title}}</td>
                                        <td>{% if post.visibility == 1 %}
                                            Published
                                        {% else %}
                                            Moderation
                                        {% endif %}</td>
                                        <td><a href="/dashboard/edit/{{post.id}}" class="btn btn-primary">Edit</a></td>
                                        <td><a href="/dashboard/delete/{{post.id}}" class="btn btn-danger">Delete</a></td>
                                    </tr>
                                {% endfor %}
                            </table>
                         
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

            {% endblock %}
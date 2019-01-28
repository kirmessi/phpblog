{% extends "index.php" %}
{% block title %}Contact{% endblock %}
{% block sliderimage %}<header class="masthead" style="background-image: url('/images/contact-bg.jpg')">{% endblock %}

                  {% block slidertitle %}Contact{% endblock %} 
                   {% block subslidertitle %}Fell free to contact me{% endblock %}
            {% block content %}
            <form action="/contact" method="post">
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                        <p><input type="text" class="form-control" name="name" placeholder="Name"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                        <p><input type="text" class="form-control" name="email" placeholder="E-mail"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                        <p><textarea rows="5" class="form-control" name="text" placeholder="Comment"></textarea></p>
                    </div>
                </div>
                <br>
                <div id="success"></div>
                <div class="form-group">
                    <button type="submit" name="Enter" class="btn btn-secondary" id="sendMessageButton">Send</button>
                </div>
            </form>
            {% endblock %}
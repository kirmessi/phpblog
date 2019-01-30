{% extends "index.php" %}
{% block title %}Register{% endblock %}
{% block sliderimage %}<header class="masthead" style="background-image: url('/images/contact-bg.jpg')">{% endblock %}

                  {% block slidertitle %}Welcome{% endblock %} 
                   {% block subslidertitle %}Join to us!{% endblock %}
            {% block content %}
            <form action="/register" method="post">
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                        <p><input type="text" class="form-control" name="username" placeholder="Username"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                        <p><input type="text" class="form-control" name="email" placeholder="E-mail"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                         <p><input type="password" class="form-control" name="password" placeholder="Password"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                         <p><input type="password" class="form-control" name="repassword" placeholder="Repeat Password"></p>
                    </div>
                </div>
                <br>
                <div id="success"></div>
                <div class="form-group">
                    <button type="submit" name="Enter" class="btn btn-secondary" id="sendMessageButton">Register</button>
                </div>
            </form>
            {% endblock %}
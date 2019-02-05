{% extends "index.php" %}
{% block title %}Contact{% endblock %}
{% block sliderimage %}<header class="masthead" style="background-image: url('/images/contact-bg.jpg')">{% endblock %}

                  {% block slidertitle %}Settings{% endblock %} 
                   {% block subslidertitle %}{% endblock %}
            {% block content %}
            <form action="/dashboard/settings" method="post">
               
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                        <p><input type="text" class="form-control" value="{{data.email}}" name="email" placeholder="E-mail"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                         <p><input type="password" class="form-control" name="password" placeholder="New password"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                         <p><input type="password" class="form-control" name="repassword" placeholder="Repeat New Password"></p>
                    </div>
                </div>
                <br>
                <div id="success"></div>
                <div class="form-group">
                    <button type="submit" name="Enter" class="btn btn-secondary" id="sendMessageButton">Save</button>
                </div>
            </form>
            {% endblock %}
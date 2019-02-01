
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
                    <div class="col-sm-4">
                        <form action="/dashboard/add/" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Название</label>
                                <input class="form-control" type="text" name="name">
                            </div>
                            <div class="form-group">
                                <label>url</label>
                                <input class="form-control" type="text" name="slug">
                            </div>
                            <div class="form-group">
                                <label>Описание</label>
                                <input class="form-control" type="text" name="description">
                            </div>
                            <div class="form-group">
                                <label>Текст</label>
                                <textarea class="form-control" rows="3" name="text"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Изображение</label>
                                <input class="form-control" type="file" name="img">
                            </div>
                             <div class="form-group">
                            <select class="form-control select2 select2-hidden-accessible" name="category_id" data-placeholder="Select a Category" style="width: 100%;" tabindex="-1" aria-hidden="true">
                              {% for category in categories %}
                            
                             <option value="{{category.category_id}}">{{category.name}}</option>
                           
                          
                            {% endfor %}
                              </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Добавить</button>
                        </form>
                    </div>
                </div>
            {% endblock %}
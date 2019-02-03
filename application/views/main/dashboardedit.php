
{% extends "index.php" %}
{% block title %}Dashboard{% endblock %}
{% block sliderimage %}<header class="masthead" style="background-image: url('/images/contact-bg.jpg')">{% endblock %}
                  {% block slidertitle %}
                  	
                  Edit the post
                  
                  {% endblock %} 
                  {% block subslidertitle %}{% endblock %}
            {% block content %}
         <div class="row">
                    <div class="col-sm-12">
                        <form action="/dashboard/edit/{{data.id}}" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Post title</label>
                                <input class="form-control" type="text" value="{{data.name|escape}}" name="name">
                            </div>
                            <div class="form-group">
                                <label>Post slug</label>
                                <input class="form-control" type="text" value="{{data.slug|escape}}" name="slug">
                            </div>
                            <div class="form-group">
                                <label>Short description</label>
                                <input class="form-control" type="text" value="{{data.description|escape}}" name="description">
                            </div>
                            <div class="form-group">
                                <label>Content</label>
                                <textarea class="form-control" rows="3" name="text">{{data.text|escape}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Choose image</label>
                                <input class="form-control" type="file" name="img">
                            </div>
                             <div class="form-group">
                              <label>Select the category</label>
                            <select class="form-control select2 select2-hidden-accessible" name="category_id" data-placeholder="Select a Category" style="width: 100%;" tabindex="-1" aria-hidden="true">
                              {% for category in categories %}
                            
                            <option value ="{{category.category_id}}" 
                            {%if category.category_id == data.category_id %}
                          selected{% endif %} >{{category.name}}</option>
                         
                            {% endfor %}
                              </select>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="visibility" name="visibility" 
                                {% if data.visibility ==1 %}
                                checked
                                {% endif %}>
                                <label for="visibility">Publish</label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Save</button>
                        </form>
                    </div>
                </div>
            {% endblock %}
         
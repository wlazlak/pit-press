{# Menu #}
<ul class="list tabs">
  {% if resource is defined %}
    <li><span>{% if etag is defined %}<a id="{{ etag.id }}" class="btn-star{% if etag.isStarred() %} active{% endif %}" title="aggiungi ai preferiti"><i class="icon-star icon-large"></i></a>{% endif %}&nbsp;<b>{{ resource }}</b></span></li>
    {% set controllerPath = resource~'/' %}
  {% else %}
    {% set controllerPath = '' %}
  {% endif %}
  {% if buttonLabel is defined %}
  <li class="pull-right icon"><a href="//{{ domainName~buttonLink }}" class="icon-plus icon-large"> {{ buttonLabel }}</a></li>
  {% endif %}
  {% for name, actionPath in menu %}
  <li{{ (name == actionName) ? ' class="active pull-right"' : ' class="pull-right"' }}><a href="//{{ domainName~'/'~controllerPath~actionPath }}/">{{ actionPath|minustospace }}</a></li>
  {% endfor %}
</ul>
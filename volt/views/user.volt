{% extends "templates/base.volt" %}

{% block content %}
  <div id="content">
  {% include "partials/navigation/tabs/user.volt" %}
  {% include "partials/navigation/tabs.volt" %}
  {% include "partials/navigation/pills.volt" %}

  {% if actionName == 'byName' %}
    <div class="ghost gutter">
      <form method="get" action="search.php" autocomplete="off" name="form_search">
        <div>Cerca tra gli utenti:&nbsp;&nbsp;<input type="text" style="width: 200px;" placeholder="Nome utente" autocomplete="on" id="keyword" name="keyword" /></div>
      </form>
    </div>
  {% endif %}

  {% if users is defined %}
    {% for user in users %}
      {% set modulus = loop.index % 4 %}
      {% set url = '//'~domainName~'/'~user.username %}
      {% if loop.first %}
      <ul class="list gutter">
      {% endif %}
        <li style="width: 25%;">
          <section class="item-user">
            <a class="avatar" href="{{ url }}"><img class="img-polaroid" src="{{ user.gravatar }}&s=48" /></a>
            <div class="reputation ext">
              <table>
                <tr><td>2345</td></tr>
                <tr><td>REPUTAZIONE</td></tr>
                <tr><td><span class="badges"><i class="icon-certificate gold"></i> 12<i class="icon-certificate silver"></i> 14<i class="icon-certificate bronze"></i> 122</span></td></tr>
              </table>
            </div>
            <a class="username" href="{{ url }}">{{ user.username }}</a>
          </section>
        </li>
      {% if loop.last %}
        {% for i in 1..modulus  %}
        <li style="width: 25%;"></li>
        {% endfor  %}
      </ul>

      <hr>
      {% elseif (modulus == 0) %}
      </ul>

      <hr>

      <ul class="list gutter">
      {% endif %}
      {% elsefor %}
      <div class="alert alert-info">Siamo spiacenti, la ricerca non ha prodotto alcun risultato.</div>
    {% endfor %}
    {% include "partials/pagination.volt" %}
  {% endif %}
  </div>
{% endblock %}
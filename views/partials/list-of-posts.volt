{% set usersBaseUrl = '//utenti.'~domainName~'/' %}
{% if entries is defined %}
  {% for entry in entries %}
    {% set userUrl = usersBaseUrl~entry.userId %}
    {% set postType = entry.type %}
    {% include "partials/helpers/tag.volt" %}
    <hr class="fade">
    <div class="item-time">{{ entry.whenHasBeenPublished }}</div>
    <div class="item-tools">
      <a href="#"><i class="icon-arrow-up icon-large"></i></a>{{ entry.score }}<a href="#"><i class="icon-arrow-down icon-large"></i></a>
      <a href="#"><i class="icon-comments icon-large"></i></a>{{ entry.replaysCount }}
    </div>
    <section class="item-content shift">
      <a class="item-title" href="{{ entry.url }}">{{ entry.title }}</a><br />
      <div class="item-excerpt">{{ entry.excerpt }}</div>
      <div class="ghost gutter">
        <ul class="list item-tags">
          <li><a class="tag {{ entry.type }}" href="{{ sectionUrl }}">{{ section }}</a></li>
          {% set tags = entry.tags %}
          {% for tag in tags %}
            <li><a class="tag" href="/tag/">{{ tag['value'] }}</a></li>
          {% endfor %}
          <li class="space"></li>
        </ul>
        {% if showUser is defined %}
        <section class="item-user pull-right">
          <a class="avatar" href="{{ userUrl }}"><img class="img-polaroid" src="{{ entry.gravatar }}&s=48" /></a>
          <div class="reputation">
            <div>2345</div>
            <div>REPUTAZIONE</div>
            <div><i class="icon-certificate gold"></i> 12<i class="icon-certificate silver"></i> 14<i class="icon-certificate bronze"></i> 122</div>
          </div>
          <a class="username" href="{{ userUrl }}">{{ entry.displayName }}</a>
        </section>
        {% endif %}
      </div>
    </section>

    {% elsefor %}
    <div class="alert alert-info">Siamo spiacenti, la ricerca non ha prodotto alcun risultato.</div>
  {% endfor %}
{% endif %}
{{ html.css('view', null, {'inline': false}) }}

{{ html.script(['view/pop', 'view/main'], {'inline': false}) }}

<h2>Lekcia: {{ lesson['Lesson']['name'] }}</h2>
<h3>Kurz: {{ lesson['Course']['name'] }}</h3>

<div class="blocks">
	{% for block in lesson['Block'] %}
		<div class="block {{ block['target'] }}"
			 id="{{ block['id'] }}"
			 style="{{ block['style'] }}">

		</div>
	{% endfor %}
</div>

<div class="clearfix"></div>

<div class="chapters">
	<ul>
	{% for title, time in layout.getLessonChapters(lesson['Block']) %}
		<li>{{ html.link(title, '#', {'data-time': time, 'class': 'chapter'}) }}</li>
	{% endfor %}
	</ul>

</div>
{{ html.css(['smoothness/jquery-ui-1.10.3.custom.min', 'view'], null, {'inline': false}) }}

{{ html.script(['lib/jquery-ui-1.10.3.custom.min', 'lib/jcarousel/core', 'lib/jcarousel/core_plugin',
	'view/main', 'view/popcorn', 'view/scroller', 'view/chapter', 'view/maximize', 'view/content', 'view/functions'],
	{'inline': false}) }}

<h2>Lesson: {{ lesson.Lesson.name }}</h2>
<h3>Course: {{ lesson.Course.name }}</h3>
<p><b>Description: </b>{{ lesson.Lesson.description }}</p>

<div class="blocks">
	{% for block in lesson.Block %}
		<div
			class="block {{ block.target }}"
			id="{{ block.id }}"
			style="{{ block.style }}"
			data-style="{{ block.style }}">

			{% if block.Timestamp %}
				{% include 'Elements/view/scroller.tpl' %}
			{% endif %}

			<div id="popcorn-container{{ block.id }}" class="popcorn-container"></div>

			{% include 'Elements/view/tools.tpl' %}
		</div>
	{% endfor %}

</div>


<div class="chapters">
	<ul>
		{% for chapter in layout.getLessonChapters(lesson.Block) %}
			<li>{{ html.link(chapter.name, '#', {
				'data-start': chapter.start, 'data-end': chapter.end, 'class': 'chapter'}) }}</li>
		{% endfor %}
	</ul>
</div>

<div class="global-restore">
	<span class="typcn typcn-arrow-minimise-outline restore"></span>
</div>
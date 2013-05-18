{{ html.css(['smoothness/jquery-ui-1.10.3.custom.min', 'typicons_kit/css/typicons', 'view', 'editor'], null, {'inline': false}) }}

{{ html.script(['lib/jquery-ui-1.10.3.custom.min', 'view/pop', 'lib/phpJS/dirname', 'lib/phpJS/basename', 'lib/phpJS/pathinfo',
	'editor/backbone/globals', 'editor/backbone/functions',
	'editor/backbone/models/attachment', 'editor/backbone/models/block', 'editor/backbone/models/lesson',
		'editor/backbone/models/timestamp',
	'editor/backbone/views/add_buttons', 'editor/backbone/views/save_button', 'editor/backbone/views/block',
		'editor/backbone/views/blocks', 'editor/backbone/views/blocks_rows', 'editor/backbone/views/block_row',
		'editor/backbone/views/lesson',	'editor/backbone/views/timestamp', 'editor/backbone/views/timeline', 'editor/backbone/views/pin',
	'editor/backbone/_app', 'editor/main', 'editor/effects'],
	{'inline': false}) }}


<div class="lesson-info">
	<h2 class="lesson-name">Lekcia: </h2>
	<h3 class="course-name">Kurz: </h3>
</div>

<div class="add-buttons">
	{{ html.link('Add block', '#', {'class': 'add-block', 'data-what': 'block'}) }}
	{{ html.link('Add attachment', '#', {'class': 'add-attachment', 'data-what': 'attachment'}) }}
	<div class="input-name">
		{{ form.input('name', {'placeholder': 'Write name and press Enter', 'label': false, 'div': false}) }}
	</div>
</div>

<div class="blocks">
	{# tu budu bloky, #popcorn-container #}
</div>

<div class="timeline">
	{# casova os videa spolu s PINmi #}
</div>

<div class="blocks-rows">
	{# riadky pre jednotlive bloky #}
</div>

<div class="chapters">
	<ul>
		{# pripadne kapitoly #}
	</ul>
</div>


<div class="save-lesson">
	{{ html.link('Save lesson', {'admin': true, 'action': 'index'}, {'class': 'save-button'}) }}
</div>
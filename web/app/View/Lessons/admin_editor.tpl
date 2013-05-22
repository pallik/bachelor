{{ html.css(['smoothness/jquery-ui-1.10.3.custom.min', 'typicons_kit/css/typicons', 'view', 'editor'], null, {'inline': false}) }}

{{ html.script(['lib/jquery-ui-1.10.3.custom.min', 'view/popcorn', 'lib/phpJS/dirname', 'lib/phpJS/basename', 'lib/phpJS/pathinfo',
	'editor/backbone/globals', 'editor/backbone/functions',
	'editor/backbone/models/attachment', 'editor/backbone/models/block', 'editor/backbone/models/lesson',
		'editor/backbone/models/timestamp',
	'editor/backbone/views/add_buttons', 'editor/backbone/views/save_button', 'editor/backbone/views/block',
		'editor/backbone/views/blocks', 'editor/backbone/views/blocks_rows', 'editor/backbone/views/block_row',
		'editor/backbone/views/lesson',	'editor/backbone/views/timestamp', 'editor/backbone/views/timeline', 'editor/backbone/views/pin',
	'editor/backbone/_app', 'editor/main', 'editor/effects'],
	{'inline': false}) }}



{# basic lesson info #}
<div class="lesson-info">
	<h2 class="lesson-name">Lesson: </h2>
	<h3 class="course-name">Course: </h3>
</div>


{# buttons for adding blocks and attachments #}
<div class="add-buttons">
	{{ html.link('Add block', '#', {'class': 'add-block'}) }}
	{{ html.link('Add attachment to block', '#', {'class': 'add-attachment'}) }}

	{# template #}
	{% include 'Elements/editor/list_attachments.tpl' %}

	<div class="attachments" title="Add attachments to block">
		{# list of attachments from template #}
	</div>
</div>


<div class="blocks">
	{# all block divs, #popcorn-container #}
</div>


<div class="timeline">
	{# timeline with PINs #}
</div>


<div class="blocks-rows">
	{# rows for blocks with timestamps #}
</div>


<div class="chapters">
	<ul>
		{# chapters #}
	</ul>
</div>


{# Buttons for save, apply, refresh #}
<div class="save-lesson">
	{{ html.link('Save', {'admin': true, 'action': 'index'}, {'class': 'save-button'}) }}
	|
	{{ html.link('[Apply]', {'admin': true, 'action': 'index'}, {'class': 'save-button'}) }}
	|
	{{ html.link('Refresh lesson', '#', {'class': 'refresh-lesson'}) }}
</div>
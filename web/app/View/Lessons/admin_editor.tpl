{{ html.css(['smoothness/jquery-ui-1.10.3.custom.min', 'context_menu/jquery.contextMenu',
	'view', 'editor'], null, {'inline': false}) }}

{{ html.script(['lib/jquery-ui-1.10.3.custom.min', 'view/popcorn', 'lib/phpJS/dirname', 'lib/phpJS/basename', 'lib/phpJS/pathinfo',
	'lib/jquery.contextMenu',
	'editor/backbone/globals', 'editor/backbone/functions',
	'editor/backbone/models/attachment', 'editor/backbone/models/block', 'editor/backbone/models/lesson',
		'editor/backbone/models/timestamp',
	'editor/backbone/views/add_buttons', 'editor/backbone/views/save_button', 'editor/backbone/views/block',
		'editor/backbone/views/blocks', 'editor/backbone/views/blocks_rows', 'editor/backbone/views/block_row',
		'editor/backbone/views/lesson',	'editor/backbone/views/timestamp', 'editor/backbone/views/timeline', 'editor/backbone/views/pin',
		'editor/backbone/views/chapters', 'editor/backbone/views/chapter',
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
	{# template #}
	{% include 'Elements/editor/set_chapter.tpl' %}

	<div class="edit-chapter-dialog" title="Set chapter">
		{# loaded template goes here #}
	</div>

	<h4>Chapters</h4>
	<ul>
		{# chapters #}
	</ul>
</div>


{# Buttons for save, apply #}
<div class="save-lesson">
	{{ html.link('Save', {'admin': true, 'action': 'index'}, {'class': 'save-button'}) }}
	|
	{{ html.link('Apply', {1: _view.params.pass[0]}, {'class': 'save-button'}) }}
	|
	{{ html.link('Back to lessons', {'admin': true, 'action': 'index'}, {'class': 'back'}) }}
</div>

<div class="refresh-view-lesson">
	{{ html.link('Refresh lesson', {1: _view.params.pass[0]}, {'class': 'refresh-lesson'}) }}
	|
	{{ html.link('View lesson', {'admin': false, 'action': 'view', 1: _view.params.pass[0]}, {'class': 'refresh-lesson'}) }}
</div>
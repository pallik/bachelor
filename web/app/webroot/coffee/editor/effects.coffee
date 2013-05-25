$ ->

	$(document).on 'click', '.popcorn-container a', (e) ->
		e.preventDefault()


	$.contextMenu
		selector: '.with-context-menu'
		callback: (key) ->
			$(@).trigger key
		items:
			'setChapter':
				name: "<span class='typcn typcn-edit'></span> Add/Edit chapter"
			'deleteTimestamp':
				'name': "<span class='typcn typcn-delete'></span> Delete timestamp"
			'highlightTimestamp':
				'name': "<span class='typcn typcn-zoom'></span> Highlight timestamp"
class Bachelor.Views.ChapterView extends Backbone.View

	tagName: 'li'


	events:
		'click .delete-chapter': 'deleteChapter'
		'click .edit-chapter': 'editChapter'
		'click .highlight-timestamp': 'highlightTimestamp'
		'click a': 'jumpToTime'


	initialize: ->
		@model.chapterView = @
		Backbone.Events.on 'popcornTimeUpdate', @checkChapterActiveInTime


	render: ->
		@setContent()
		@showChapter()
		return @


	setContent: ->
		chapterName = @model.get 'chapter'
		link = "<a href='#' class='chapter'></a>"
		@$el.html link
		@$el.find('a').text chapterName
		@addEditChapterIcon()
		@addDeleteChapterIcon()
		@addHighlightTimestampIcon()


	addDeleteChapterIcon: ->
		icon = "<span class='typcn typcn-delete delete-chapter'></span>"
		@$el.append icon


	addEditChapterIcon: ->
		icon = "<span class='typcn typcn-edit edit-chapter'></span>"
		@$el.append icon


	addHighlightTimestampIcon: ->
		icon = "<span class='typcn typcn-zoom highlight-timestamp'></span>"
		@$el.append icon


	deleteChapter: =>
		@model.setChapterNull()


	editChapter: =>
		Bachelor.App.Views.chaptersView.loadEditChapterDialogTemplate @model


	highlightTimestamp: =>
		@model.highlightTimestamp()


	highlightTimestampIcon: ->
		@$el.addClass 'highlight-timestamp-icon'


	unHighlightTimestampIcon: ->
		@$el.removeClass 'highlight-timestamp-icon'


	hideChapter: ->
		@$el.hide()


	showChapter: ->
		@$el.show()


	checkChapterActiveInTime: (currentTime) =>
		status = @model.get 'status'
		hasChapter = @model.get 'chapter'
		if status and hasChapter
			start = @model.get 'start'
			end = @model.get 'end'
			currentTime = Math.floor currentTime

			$link = @$el.find 'a'
			if currentTime >= start and currentTime < end
				$link.addClass 'active' if not $link.hasClass 'active'
			else
				$link.removeClass 'active'


	jumpToTime: (e) =>
		e.preventDefault()
		start = @model.get 'start'
		Bachelor.App.pop.jumpTo start
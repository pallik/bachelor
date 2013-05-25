class Bachelor.Views.ChaptersView extends Backbone.View

	el: $('.chapters')

	editChapterDialog: null


	initialize: ->
		Bachelor.App.Collections.timestamps.on 'add', @addChapterView
		Bachelor.App.Collections.timestamps.on 'change:status change:chapter', @rearrangeChapter
		@editChapterDialog = @$el.find '.edit-chapter-dialog'
		@initEditChapterDialog()


	addChapterView: (timestamp) =>
		chapterView = new Bachelor.Views.ChapterView model: timestamp


	rearrangeChapter: =>
		Bachelor.App.Collections.timestamps.each (timestamp) =>
			status = timestamp.get 'status'
			hasChapter = timestamp.get('chapter')?

			if status and hasChapter
				@$el.find('ul').append( timestamp.chapterView.render().el )
			else
				timestamp.chapterView.hideChapter()


	initEditChapterDialog: ->
		@editChapterDialog.dialog
			modal: true
			autoOpen: false
			width: 450
			buttons:
				'Set chapter': =>
					@setNewChapter() if @validateNewChapter()
				'Cancel': ->
					$(@).dialog 'close'


	loadEditChapterDialogTemplate: (@editChapterModel) ->
		chapter = @editChapterModel.get 'chapter'
		template = _.template( @$el.find('#editChapter').html(), chapter: chapter)
		@editChapterDialog.html template
		@editChapterDialog.dialog 'open'


	validateNewChapter: =>
		input = @editChapterDialog.find '#chapterName'
		if input.val().length < 1
			input.after "<span class='error-message'>Chapter length must be at least 1 character.</span>"
			return false
		return true


	setNewChapter: =>
		newChapter = @editChapterDialog.find('#chapterName').val()
		@editChapterModel.set 'chapter', newChapter
		@editChapterDialog.dialog 'close'
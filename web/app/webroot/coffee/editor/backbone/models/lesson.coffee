class Bachelor.Models.Lesson extends Backbone.Model

	urlRoot: "#{app.url}/admin/lessons"

	defaults:
		status: true


	initialize: ->
		@fetch
			success: =>
				@setNewAttributes()
				@lessonInfo = new Bachelor.Views.LessonView model: @


#	replace defaults
	setNewAttributes: ->
		newAttributed = @get('data').Lesson
		_.extend(@attributes, newAttributed)


	getRelatedData: (model, field) =>
		@get('data')[model][field]
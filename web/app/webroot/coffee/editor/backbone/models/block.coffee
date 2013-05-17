class Bachelor.Models.Block extends Backbone.Model

	defaults:
		status: true
		master: false
		lesson_id: Bachelor.lessonId
		color: '#000000'


	initialize: ->
		@set 'color',  getRandomColor()


	isMasterVideo: ->
		@get 'master'


class Bachelor.Collections.Blocks extends Backbone.Collection

	model: Bachelor.Models.Block

	url: "#{app.url}/admin/blocks"
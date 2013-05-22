root = exports ? this
root.pop = null

$ ->
	Lesson = Backbone.Model.extend(urlRoot: app.url + "/lessons")

	id = app.request.params.pass[0]
	lesson = new Lesson(id: id)

	###
        load all lesson data
	###
	lesson.fetch
		success: (data) ->
			handleLessonResult data.toJSON()

######################### functions ###########################

	###
	  hande result from ajax
	###
	handleLessonResult = (data) ->
		handlePopcorn(data.lesson)
		$('.blocks').trigger 'adjustBlocksContainerHeight'

	###
		create popcorn instance
        add popcorn elements
		on time update thumbnails-scroller and chapters
	###
	handlePopcorn = (lesson) ->
		root.pop = new Pop lesson.Attachment.url
		root.pop.addPopcornElements lesson.Block
		root.pop.onTimeUpdate()
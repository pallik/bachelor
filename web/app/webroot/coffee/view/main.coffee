$ ->
	root = exports ? this
	root.pop = null

	Lesson = Backbone.Model.extend(urlRoot: app.url + "/lessons")

	id = window.location.href.substr -1
	lesson = new Lesson(id: id)

	###
    load all lesson data
  ###
	lesson.fetch
		success: (data) ->
			handleLessonResult data.toJSON()

	###
    handle click chapter
  ###
	$('.chapter').click (event) ->
		event.preventDefault()
		time = $(@).data 'time'
		root.pop.jumpTo(time)



######################### functions ###########################

	###
	  hande result from ajax
	###
	handleLessonResult = (data) ->
		console.log data
		handlePopcorn(data.lesson)

	###
	  create popcorn instance
	###
	handlePopcorn = (lesson) ->
		root.pop = new Pop lesson.Attachment.url
		root.pop.addPopcornElements(lesson.Block)
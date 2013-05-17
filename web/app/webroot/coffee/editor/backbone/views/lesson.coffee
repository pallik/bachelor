class Bachelor.Views.LessonView extends Backbone.View

	el: $('.lesson-info')

	initialize: ->
		@render()

	render: ->
		@setInfoContent()

	setInfoContent: ->
		lessonName = @model.get 'name'
		courseName = @model.getRelatedData 'Course', 'name'
		@$('.lesson-name').text lessonName
		@$('.course-name').text courseName
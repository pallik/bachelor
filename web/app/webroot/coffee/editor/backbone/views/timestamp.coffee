class Bachelor.Views.TimestampView extends Backbone.View

	tagName: 'div'
	className: 'thumbnail'
	id: ''


#	events:


	initialize: ->
		@model.on 'change', @render
		@model.view = @


	render: =>
		@setContent()
		@appendAttachment()
		return @


	setContent: ->
		@attributes =
			"data-start": @model.get 'start'
			"data-end": @model.get 'end'

		@$el.attr @attributes


	appendAttachment: ->
		@$el.empty()
		@attachment = @model.get 'Attachment'
		type = @attachment.Type.name
		if type is 'image' then @appendImage() else @appendText()


	appendImage: ->
		urlInfo = pathinfo(app.url + @attachment.url)
		thumbUrl = urlInfo.dirname + '/thumb/' + urlInfo.basename
		img = "<img src=\"#{thumbUrl}\" />"
		@$el.append img


	appendText: ->
		@$el.append @attachment.name

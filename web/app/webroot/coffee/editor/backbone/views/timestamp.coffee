class Bachelor.Views.TimestampView extends Backbone.View

	tagName: 'div'
	className: 'thumbnail'
	id: ''


	events:
		'click': 'handleClick'


	initialize: ->
		@model.view = @
		@$el.on 'setChapter', @model.setChapter
		@$el.on 'deleteTimestamp', @onDeleteTimestamp
		@$el.on 'highlightTimestamp', @model.highlightTimestamp


	render: =>
		@setContent()
		@appendAttachment()
		@setOpacity()
		return @


	setContent: ->
		@attributes =
			"data-start": @model.get 'start'
			"data-end": @model.get 'end'

		@$el.attr @attributes

		if @model.get 'status'
			@$el.addClass 'with-context-menu'
		else
			@$el.removeClass 'with-context-menu'


	appendAttachment: ->
		@$el.empty()
		@attachment = @model.get 'Attachment'
		type = @attachment.Type.name
		if type is 'image' then @appendImage() else @appendText()


	appendImage: ->
		urlInfo = pathinfo(app.url + @attachment.url)
		thumbUrl = urlInfo.dirname + '/thumb/' + urlInfo.basename
		img = "<img src=\"#{thumbUrl}\" class='thumbnail-content' />"
		@$el.append img


	appendText: ->
		textDiv = "<div class='text thumbnail-content'>#{@attachment.name}</div>"
		@$el.append textDiv


	setOpacity: ->
		@$el.find('.thumbnail-content').css('opacity', 0.7) if @model.isSet()


	handleClick: (e) =>
		LEFT_CLICK = 1
		@handleLeftClick() if e.which is LEFT_CLICK


	handleLeftClick: ->
		if @model.get 'status'
			@toggleDraggable()
		else
			@toggleStartEnd()


	toggleDraggable: =>
		if @$el.hasClass 'highlight'
			@disableDraggable()
		else
			blockCid = @model.get 'blockCid'
			Bachelor.App.Views.blocksRowsView.disableAllTimestampsDraggable blockCid

			@model.pinStartView.enableDraggable()
			@model.pinEndView.enableDraggable()
			@model.chapterView.highlightTimestampIcon()
			@model.set 'highlight', true
			@$el.addClass 'highlight'


	disableDraggable: ->
		@model.pinStartView.disableDraggable()
		@model.pinEndView.disableDraggable()
		@model.chapterView.unHighlightTimestampIcon()
		@model.set 'highlight', false
		@$el.removeClass 'highlight'


	toggleStartEnd: ->
		currentTime = Bachelor.App.pop.popcorn.currentTime()
		if @model.get 'timing'
			@setTimingEnd currentTime
		else
			blockCid = @model.get 'blockCid'
			Bachelor.App.Views.blocksRowsView.setAllTimestampsTimingEnd blockCid, currentTime
			@setTimingStart currentTime


	setTimingStart: (currentTime) ->
		@model.set 'timing', true
		@model.set 'start', currentTime
		@$el.toggleClass 'highlight'


	setTimingEnd: (currentTime = Bachelor.App.pop.popcorn.currentTime()) ->
		@model.set 'timing', false
		@model.set 'end', currentTime
		@model.set 'status', true
		@$el.toggleClass 'highlight'
		@render()
		@addTimestampToPopcorn()
		Backbone.Events.trigger 'renderAllTimestamps'


	addTimestampToPopcorn: ->
		type = @model.get('Attachment').Type.name
		timestamp = @model.attributes
		Bachelor.App.pop.addPopcornImage(timestamp) if type is 'image'
		Bachelor.App.pop.addPopcornText(timestamp) if type is 'text'


	onDeleteTimestamp: =>
		@disableDraggable()
		@model.setTimestampFalse()
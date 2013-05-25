class Bachelor.Views.PinView extends Backbone.View

	tagName: 'span'
	className: 'timeline-pin typcn with-context-menu'

	disabledClasses:
		start: 'typcn-arrow-down-thick'
		end: 'typcn-arrow-up-thick'

	enabledClasses:
		start: 'typcn-arrow-down-outline'
		end: 'typcn-arrow-up-outline'


	ratio: null


	events:
		'click': 'updateTime'


	initialize: ->
		@side = @options.side
		@$el.addClass @side
		@$el.addClass @disabledClasses[@side]

		@model.pinStartView = @ if @side is 'start'
		@model.pinEndView = @ if @side is 'end'

		Backbone.Events.on 'durationchange', @render
		@$el.on 'setChapter', @model.setChapter
		@$el.on 'deleteTimestamp', @model.setTimestampFalse
		@$el.on 'highlightTimestamp', @model.highlightTimestamp

		@setContent()
		@setDraggable()


	render: =>
		@setRatio()
		@setPosition()
		return @


	setContent: ->
		blockCid = @model.get 'blockCid'
		block = Bachelor.App.Collections.blocks.get blockCid
		blockIndexOf = Bachelor.App.Collections.blocks.indexOf block

		constant = -13 if @side is 'start'
		constant = 13 if @side is 'end'

		marginTop = (blockIndexOf - 1) * constant
		color = block.get 'color'

		@$el.css color: color, marginTop: marginTop, position: 'absolute'


	setDraggable: ->
		@$el.draggable
			axis: 'x'
			containment: 'parent'
			disabled: true
			stop: @updateModelOnStopDragging


	enableDraggable: ->
		@$el.removeClass @disabledClasses[@side]
		@$el.addClass @enabledClasses[@side]
		@$el.addClass 'highlight'

		@$el.draggable 'option', 'disabled', false


	disableDraggable: ->
		@$el.removeClass @enabledClasses[@side]
		@$el.addClass @disabledClasses[@side]
		@$el.removeClass 'highlight'

		@$el.draggable 'option', 'disabled', true
		@$el.removeClass 'ui-state-disabled'


	setPosition: ->
		if @ratio
			start = @model.get @side
			position = start / @ratio
			@$el.css 'left', "#{position}%"


	setRatio: ->
		@ratio ?= Bachelor.App.Views.timelineView.ratio


	updateModelOnStopDragging: (event, ui) =>
		totalWidth = @$el.closest('.timeline').width()
		pinPosition = ui.position.left
		positionInPercentage = pinPosition / totalWidth * 100
		newTimeMark = positionInPercentage * @ratio
		@model.set @side, newTimeMark
		Backbone.Events.trigger 'renderAllTimestamps'


	updateTime: =>
		time = @model.get @side
		Bachelor.App.pop.jumpTo time
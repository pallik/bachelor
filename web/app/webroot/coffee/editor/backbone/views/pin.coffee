class Bachelor.Views.PinView extends Backbone.View

	tagName: 'span'
	className: 'timeline-pin typicn location'

	ratio: null

#	events:
#	todo: tahanie mysou, kliknutie lavym = zmena slajdera, kliknutie pravym = kontextova ponuka


	initialize: ->
#		@model.on 'change', @render #asi nebude
		@model.pinView = @
		Backbone.Events.on 'durationchange', @render
		@setContent()


	render: =>
		@setRatio()
		@setPosition()
		return @


	setContent: ->
		blockCid = @model.get 'blockCid'
		block = Bachelor.App.Collections.blocks.get blockCid
		blockIndexOf = Bachelor.App.Collections.blocks.indexOf block

		marginTop = (blockIndexOf - 1) * -13
		color = block.get 'color'

		@$el.css color: color, marginTop: marginTop


	setPosition: ->
		if @ratio
			start = @model.get 'start'
			position = start / @ratio
			@$el.css 'left', "#{position}%"


	setRatio: ->
		@ratio ?= Bachelor.App.Views.timelineView.ratio
class Bachelor.Views.PinView extends Backbone.View

	tagName: 'span'
	className: 'timeline-pin typicn location'

	ratio: null

#	events:
#	todo: tahanie mysou, kliknutie lavym = zmena slajdera, kliknutie pravym = kontextova ponuka


	initialize: ->
#		@model.on 'change', @render
		@model.pinView = @
		Backbone.Events.on 'durationchange', @setRatioAndPosition
		@setContent()


	render: =>
		return @
		@setPosition()


	setContent: ->
		blockId = @model.get 'block_id'
		block = Bachelor.App.Collections.blocks.where(id: blockId)[0]
		blockIndexOf = Bachelor.App.Collections.blocks.indexOf block

		marginTop = (blockIndexOf - 1) * -10
		color = block.get 'color'

		@$el.css color: color, marginTop: marginTop


	setPosition: ->
		if @ratio
			start = @model.get 'start'
			position = start / @ratio
			@$el.css 'left', "#{position}%"


	setRatioAndPosition: =>
		@ratio = Bachelor.App.pop.getRatio()
		@setPosition()
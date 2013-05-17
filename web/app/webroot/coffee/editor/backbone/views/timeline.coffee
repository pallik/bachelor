class Bachelor.Views.TimelineView extends Backbone.View

	el: $('.timeline')

	ratio: null
	sliding: false


	initialize: ->
		@setSlider()
		Backbone.Events.on 'popcornTimeUpdate', @setSliderValue
		Bachelor.App.Collections.timestamps.on 'add', @addPinView
		Backbone.Events.on 'durationchange', @setRatioAndEnableSlider



	setSlider: ->
		@$el.slider
			range: 'min'
			orientation: 'horizontal'
			step: 0.1
			start: @onStart
			stop: @onStop
			disabled: true


	onStart: =>
		@sliding = true


	onStop: (event, ui) =>
		@sliding = false
		newTime = @ratio * ui.value
		Bachelor.App.pop.jumpTo newTime


	setSliderValue: (currentTime) =>
		if not @sliding
			newSliderValue = currentTime / @ratio
			@$el.slider 'value', newSliderValue


	setRatioAndEnableSlider: =>
		@ratio = Bachelor.App.pop.getRatio()
		@$el.slider 'enable'


	addPinView: (timestamp) =>
		view = new Bachelor.Views.PinView(model: timestamp)
		@$el.append( view.render().el )
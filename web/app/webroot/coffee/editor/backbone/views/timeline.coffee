class Bachelor.Views.TimelineView extends Backbone.View

	el: $('.timeline')

	ratio: null
	sliding: false


	initialize: ->
		@setSlider()
		Backbone.Events.on 'popcornTimeUpdate', @setSliderValue
		Backbone.Events.on 'durationchange', @setRatioAndEnableSlider
		Bachelor.App.Collections.timestamps.on 'add', @addPinView
		Bachelor.App.Collections.timestamps.on 'change:status', @togglePin



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
		viewStart = new Bachelor.Views.PinView(model: timestamp, side: 'start')
		viewEnd = new Bachelor.Views.PinView(model: timestamp, side: 'end')


	togglePin: (timestamp) =>
		status = timestamp.get 'status'
		if status
			@$el.append( timestamp.pinStartView.render().el )
			@$el.append( timestamp.pinEndView.render().el )
		else
			timestamp.pinStartView.remove()
			timestamp.pinEndView.remove()

class Bachelor.Views.BlockView extends Backbone.View

	tagName: 'div'
	className: 'block'
	id: ''


#	events:


	initialize: ->
		@model.on 'change', @render
		@model.view = @
		@addPopcornContainer()


	render: =>
		@setContent()
		return @


	setContent: ->
		style = @model.get 'style'
		target = @model.get 'target'
		@$el.attr 'style', style
		@$el.addClass target
		@$el.css 'border-color', @model.get 'color'


	addPopcornContainer: ->
		modelId = @model.get 'id'
		div = "<div id=\"popcorn-container#{modelId}\" class='popcorn-container'></div>"
		@$el.append div
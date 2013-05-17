class Bachelor.Views.BlockRowView extends Backbone.View

	tagName: 'div'
	className: 'block-row'
	id: ''


#	events:


	initialize: ->
#		@model.on 'change', @render
		@model.rowView = @


	render: =>
		@setContent()
		return @


	setContent: ->
		target = @model.get 'target'
		blockId = @model.get 'id'

		@$el.attr 'data-block-id', blockId
		@$el.addClass target
		@$el.css 'border-color', @model.get 'color'
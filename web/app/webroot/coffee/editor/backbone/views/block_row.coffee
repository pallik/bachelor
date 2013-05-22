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
		blockCid = @model.cid

		@$el.attr 'data-block-cid', blockCid
		@$el.addClass target
		@$el.css 'border-color', @model.get 'color'
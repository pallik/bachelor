class Bachelor.Views.BlockView extends Backbone.View

	tagName: 'div'
	className: 'block'
	id: ''

	styles:
		width: 400
		height: 400
		top: 0
		left: 0


	events:
		'click .typicn.cancel': 'delete'


	initialize: ->
#		@model.on 'change', @render
		@model.view = @
		@addPopcornContainer()
		@setResizable()
		@setDraggable()


	render: =>
		@setContent()
		return @


	setContent: ->
		target = @model.get 'target'
		style = @model.get 'style'

		@$el.attr 'style', style
		@$el.addClass target
		@$el.css position: 'absolute', borderColor: @model.get 'color'


	addPopcornContainer: ->
		modelId = @model.get 'id'
		div = "<div id=\"popcorn-container#{modelId}\" class='popcorn-container'></div>"
		@$el.append div


	setResizable: ->
		@$el.resizable
			containment: 'parent'
			stop: @editModelsSize


	setDraggable: ->
		@$el.draggable
			containment: 'parent'
			stop: @editModelsPosition

		if @model.isMasterVideo()
			@appendVideoTools()
			@$el.draggable 'option', 'handle', '.typicn.move'
		else
			@appendTools()


	appendTools: ->
		tools = "<div class='tools'><span class='typicn cancel'></span></div>"
		@$el.append tools


	appendVideoTools: ->
		tools = "<div class='tools'><span class='typicn move'></span></div>"
		@$el.append tools


	editModelsSize: (event, ui) =>
		top = "top: #{@$el.css 'top'};"
		left = "left: #{@$el.css 'left'};"
		width = "width: #{ui.size.width}px;"
		height = "height: #{ui.size.height}px;"

		newStyle = "#{top} #{left} #{width} #{height}"
		@model.set 'style', newStyle


	editModelsPosition: (event, ui) =>
		top = "top: #{ui.position.top}px;"
		left = "left: #{ui.position.left}px;"
		width = "width: #{@$el.css 'width'};"
		height = "height: #{@$el.css 'height'};"

		newStyle = "#{top} #{left} #{width} #{height}"
		@model.set 'style', newStyle


	delete: ->
		@model.delete()
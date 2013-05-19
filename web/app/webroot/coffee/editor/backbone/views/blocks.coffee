class Bachelor.Views.BlocksView extends Backbone.View

	el: $('.blocks')


	initialize: ->
		Bachelor.App.Collections.blocks.on 'add', @addBlockView
		@setResizable()


	addBlockView: (block) =>
		view = new Bachelor.Views.BlockView(model: block)
		@$el.append( view.render().el )
		adjustBlocksContainerHeight()


	setResizable: ->
		@$el.resizable containment: 'parent'
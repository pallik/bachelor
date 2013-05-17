class Bachelor.Views.BlocksView extends Backbone.View

	el: $('.blocks')

#	events:

	initialize: ->
		Bachelor.App.Collections.blocks.on 'add', @addBlockView


	addBlockView: (block) =>
		view = new Bachelor.Views.BlockView(model: block)
		@$el.append( view.render().el )
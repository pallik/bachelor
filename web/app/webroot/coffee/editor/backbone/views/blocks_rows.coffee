class Bachelor.Views.BlocksRowsView extends Backbone.View

	el: $('.blocks-rows')

#	events:

	initialize: ->
		Bachelor.App.Collections.blocks.on 'add', @addBlockRowView
		Bachelor.App.Collections.timestamps.on 'add', @addTimestampView
		Backbone.Events.on 'renderAllTimestamps', @renderAllTimestamps


	addBlockRowView: (block) =>
		if not block.isMasterVideo()
			view = new Bachelor.Views.BlockRowView(model: block)
			@$el.append( view.render().el )


	addTimestampView: (timestamp) =>
		view = new Bachelor.Views.TimestampView(model: timestamp)
		@appendTimestampViewToBlockRow timestamp


	appendTimestampViewToBlockRow: (timestamp) ->
		view = timestamp.view
		blockId = timestamp.get 'block_id'
		$blockRow = @$el.find ".block-row[data-block-id=#{blockId}]"
		$blockRow.append( view.render().el )


	renderAllTimestamps: =>
		_.each Bachelor.App.Collections.timestamps.models, (timestamp) =>
			timestamp.view.remove()
			@appendTimestampViewToBlockRow timestamp
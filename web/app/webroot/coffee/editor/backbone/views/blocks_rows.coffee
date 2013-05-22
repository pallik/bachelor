class Bachelor.Views.BlocksRowsView extends Backbone.View

	el: $('.blocks-rows')

#	events:

	initialize: ->
		Bachelor.App.Collections.blocks.on 'add', @addBlockRowView
		Bachelor.App.Collections.timestamps.on 'add', @addTimestampView
		Backbone.Events.on 'renderAllTimestamps', @renderAllTimestamps
		Backbone.Events.on 'setTimestampFalse', @setTimestampStatusFalse


	addBlockRowView: (block) =>
		if not block.isMasterVideo()
			view = new Bachelor.Views.BlockRowView(model: block)
			@$el.append( view.render().el )


	addTimestampView: (timestamp) =>
		view = new Bachelor.Views.TimestampView(model: timestamp)
		@appendTimestampViewToBlockRow timestamp


	appendTimestampViewToBlockRow: (timestamp) ->
		view = timestamp.view
		blockCid = timestamp.get 'blockCid'
		$blockRow = @$el.find ".block-row[data-block-cid=#{blockCid}]"
		$blockRow.append( view.render().el )


	renderAllTimestamps: =>
		Bachelor.App.Collections.timestamps.sort()
		_.each Bachelor.App.Collections.timestamps.models, (timestamp) =>
			@appendTimestampViewToBlockRow timestamp


	setTimestampStatusFalse: (blockCid) =>
		_.each Bachelor.App.Collections.timestamps.where(blockCid: blockCid), (timestamp) ->
			timestamp.set 'status', false


	setAllTimestampsTimingEnd: (blockCid, currentTime) =>
		_.each Bachelor.App.Collections.timestamps.where(blockCid: blockCid, status: false, timing: true), (timestamp) ->
			timestamp.view.setTimingEnd currentTime
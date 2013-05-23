class Bachelor.Views.SaveButtonView extends Backbone.View

	el: $('.save-lesson')

	events:
		'click .save-button': 'saveLesson'
		'click .refresh-lesson': 'refreshLesson'


	saveLesson: (e) =>
		e.preventDefault()

		blocks = Bachelor.App.Collections.blocks.filter (block) ->
			block.set 'cid', block.cid
			return true
		blocksData = JSON.stringify blocks
		blocksAjaxUrl = Bachelor.App.Collections.blocks.url + "/saveAll";

		ajaxPost blocksAjaxUrl, blocksData, @onBlocksSuccess, @onError


	onBlocksSuccess: (returnedData) =>
		timestampsFinished = Bachelor.App.Collections.timestamps.filter (timestamp) ->
			block = _.find returnedData.blocks, (block) ->
				return block.cid is timestamp.get 'blockCid'

			timestamp.set 'block_id', block.id if block.id?
			timestamp.set 'block_id', block.insertedId if block.insertedId?
			timestamp.view.setTimingEnd() if timestamp.get 'timing'
			return timestamp.get 'status'

		timestampsData = JSON.stringify timestampsFinished
		timestampsAjaxUrl = Bachelor.App.Collections.timestamps.url + "/saveAll";

		ajaxPost timestampsAjaxUrl, timestampsData, @onTimestampsSuccess, @onError


	onTimestampsSuccess: (returnedData) =>
		if  returnedData.success
			nextUrl = @$el.find('.save-button').attr 'href'
			window.location.href = nextUrl


	onError: (returnedData) =>
		debug returnedData


	refreshLesson: (e) =>
		e.preventDefault()
		window.location.href = app.request.here
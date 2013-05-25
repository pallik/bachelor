class Bachelor.Views.SaveButtonView extends Backbone.View

	el: $('.save-lesson')
	$link: null

	events:
		'click .save-button': 'saveLesson'


	saveLesson: (e) =>
		@$link = $(e.target)
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

			status = timestamp.get 'status'
			hasId = timestamp.get('id')?
			return status or hasId

		timestampsData = JSON.stringify timestampsFinished
		timestampsAjaxUrl = Bachelor.App.Collections.timestamps.url + "/updateAll";

		ajaxPost timestampsAjaxUrl, timestampsData, @onTimestampsSuccess, @onError


	onTimestampsSuccess: (returnedData) =>
		if  returnedData.success
			nextUrl = @$link.attr 'href'
			window.location.href = nextUrl


	onError: (returnedData) =>
		debug returnedData
class Bachelor.Views.SaveButtonView extends Backbone.View

	el: $('.save-lesson')

	events:
		'click .save-button': 'saveLesson'


	saveLesson: (e) =>
		e.preventDefault()

		blocksAjaxUrl = Bachelor.App.Collections.blocks.url + "/saveAll";
		blocks = Bachelor.App.Collections.blocks
		blocksData = JSON.stringify blocks

		timestampsAjaxUrl = Bachelor.App.Collections.timestamps.url + "/saveAll";
		timestamps = Bachelor.App.Collections.timestamps
		timestampsData = JSON.stringify timestamps

		@ajaxSend blocksAjaxUrl, blocksData
		@ajaxSend timestampsAjaxUrl, timestampsData


	ajaxSend: (url, data) ->
		$.ajax
			type: "POST"
			url: url
			contentType: 'application/json'
			data: data
			dataType: "json"
			success: @onSuccess
			error: @onError


	onSuccess: (returnedData) =>
		debug returnedData
		nextUrl = @$el.find('.save-button').attr 'href'
		window.location.href nextUrl


	onError: (returnedData) =>
		debug returnedData
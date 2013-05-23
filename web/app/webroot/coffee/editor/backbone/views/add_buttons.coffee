class Bachelor.Views.AddButtonsView extends Backbone.View

	el: $('.add-buttons')

	attachmentDialog: null

	events:
		'click .add-block': 'addBlock'
		'click .add-attachment': 'handleAddAttachment'


	initialize: ->
		@attachmentDialog = @$el.find('.attachments')
		@initAttachmentDialog()


	addBlock: (e) =>
		e.preventDefault()
		newBlock = new Bachelor.Models.Block()
		Bachelor.App.Collections.blocks.add newBlock


	handleAddAttachment: (e) =>
		e.preventDefault()
		url = Bachelor.App.Collections.attachments.url + "/list"
		@ajaxGet url


	ajaxGet: (url) ->
		$.ajax
			type: "GET"
			url: url
			dataType: "json"
			success: (data) =>
				@loadTemplate data
			error: (data) =>
				debug data


	initAttachmentDialog: ->
		@attachmentDialog.dialog
			modal: true
			autoOpen: false
			width: 'auto'
			buttons:
				'Add attachments to block': =>
					@attachmentDialog.dialog 'close'
					@getDataForRequest()
				'Cancel': ->
					$(@).dialog 'close'


	loadTemplate: (data) ->
		notMasterActiveBlocksCount = Bachelor.App.Collections.blocks.where(status: true, master: false).length
		template = _.template( @$el.find('#listAttachments').html(), data )
		template = 'You have to add blocks first!' if notMasterActiveBlocksCount is 0
		@attachmentDialog.html template
		@attachmentDialog.dialog 'open'


	getDataForRequest: ->
		$attachments = @attachmentDialog.find '.select-attachment:checked'
		attachmentsRequestData =
			presentation: new Array()
			text: new Array()
			image: new Array()

		$attachments.each ->
			type = $(@).data 'type'
			id = $(@).data 'id'
			attachmentsRequestData[type].push id

		attachmentsRequestData = JSON.stringify attachmentsRequestData
		@sendRequestForData attachmentsRequestData


	sendRequestForData: (data) ->
		url = Bachelor.App.Collections.attachments.url + "/getDataFromRequest"
		ajaxPost url, data, @addAttachmentsToBlock, debug


	addAttachmentsToBlock: (attachments) =>
		$block = @attachmentDialog.find '.select-block:checked'
		blockCid = $block.val()

		_.each attachments, (attachment) ->
			attachmentAttribute = attachment.Attachment
			attachmentAttribute['Type'] = attachment.Type

			timestampModel = new Bachelor.Models.Timestamp()
			timestampModel.set 'blockCid', blockCid
			timestampModel.set 'Attachment', attachmentAttribute
			timestampModel.set 'attachment_id', attachmentAttribute.id

			Bachelor.App.Collections.timestamps.add timestampModel

		Backbone.Events.trigger 'renderAllTimestamps'

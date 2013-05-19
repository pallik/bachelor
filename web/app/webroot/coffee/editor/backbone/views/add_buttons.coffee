class Bachelor.Views.AddButtonsView extends Backbone.View

	el: $('.add-buttons')


	events:
		'click .add-block': 'addBlock'
		'click .add-attachment': 'addAttachment'


	addBlock: (e) =>
		e.preventDefault()
		newBlock = new Bachelor.Models.Block()
		Bachelor.App.Collections.blocks.add newBlock


	addAttachment: (e) =>
		e.preventDefault()

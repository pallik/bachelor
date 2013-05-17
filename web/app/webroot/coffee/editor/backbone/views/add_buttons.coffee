class Bachelor.Views.AddButtonsView extends Backbone.View

	el: $('.add-buttons')

	events:
		'click .add-block': 'toggleInput'
		'click .add-attachment': 'toggleInput'
		'keyup input#name': 'addBlockOrAttachment'

#	pridavanie attachmentov bude asi ine

	addBlockOrAttachment: (e) =>
		ENTER_KEYCODE = 13
		ESC_KEYCODE = 27
		currentKey = e.which

		@slideUpInput() if currentKey is ESC_KEYCODE

		if currentKey is ENTER_KEYCODE
			input = @$('input')
			name = input.val()
			what = input.data 'what'
			what = capitalizeFirst what
			action = "add#{what}"

			Backbone.Events.trigger(action, name)

			@slideUpInput()


	toggleInput: (e) =>
		e.preventDefault()
		what =  $(e.target).data('what')
		@$('.input-name').slideToggle().find('input').data('what', what)


	slideUpInput: =>
		@$('.input-name').slideUp ->
			$(@).find('input').val ''
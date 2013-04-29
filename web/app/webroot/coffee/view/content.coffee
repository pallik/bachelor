$ ->

	###
        disable image click inside blocks
	###
	$(document).on 'click', '.popcorn-container a', (e) ->
		e.preventDefault()
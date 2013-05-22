$ ->

	$('.block').resizable({
		stop: (event, ui) ->
			$(@).trigger 'resize'
	}).draggable({
		handle: '.move'
		stop: (event, ui) ->
			$(@).trigger 'resize'
	})


	$('.blocks').on 'adjustBlocksContainerHeight', ->
		adjustBlocksContainerHeight()


	adjustBlocksContainerHeight = ->
		console.log 'adjusting'
		divBlocks = $('.blocks')
		maxYposition = 0

		$('.block').each ->
			offsetTop = $(@).offset().top
			height = $(@).height()
			positionY = offsetTop + height
			maxYposition = positionY if positionY > maxYposition

		blocksContainerHeight = maxYposition - divBlocks.offset().top
		divBlocks.height blocksContainerHeight
$ ->

	$('.block').resizable({
		stop: (event, ui) ->
			$(@).trigger 'resize'
		start: (event, ui) ->
			$(@).trigger 'startedResizing'
	}).draggable({
		handle: '.move'
		stop: (event, ui) ->
			$(@).trigger 'resize'
	})


	$('.blocks').on 'adjustBlocksContainerHeight', ->
		adjustBlocksContainerHeight()


	$('.block').on 'startedResizing', ->
		minimized = $(@).hasClass 'minimized'
		$(@).css('position', 'fixed') if minimized


	adjustBlocksContainerHeight = ->
		divBlocks = $('.blocks')
		maxYposition = 0

		$('.block').each ->
			offsetTop = $(@).offset().top
			height = $(@).height()
			positionY = offsetTop + height
			maxYposition = positionY if positionY > maxYposition

		blocksContainerHeight = maxYposition - divBlocks.offset().top
		divBlocks.height blocksContainerHeight
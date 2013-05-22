$ ->

	###
        handle on click maximize icon
    ###
	$('.maximize').click (e) ->
		e.preventDefault()

		$block = $(@).closest '.block'
		$otherBlocks = $('.block').not $block

		maximize $block
		minimizeAll $otherBlocks

	###
        on click close button
    ###
	$('.close').click (e) ->
		e.preventDefault()
		$block = $(@).closest '.block'
		close $block

	###
		restore button on video, cause ESC not working
    ###
	$('.restore').click (e) ->
		e.preventDefault()
		restoreAll()

	###
        restore all blocks when esc pressed
    ###
	$(document).keyup (e) ->
		KEYCODE_ESC = 27
		restoreAll() if e.keyCode is KEYCODE_ESC

	###
        when block changes its size, update img max dimensions
	###
	$('.block').resize ->
		blockWidth = $(@).width()
		blockHeight = $(@).height()
		images = $(@).find '.popcorn-container img'
		maximized = $(@).hasClass 'maximized'
		minimized = $(@).hasClass 'minimized'
		$('.blocks').trigger('adjustBlocksContainerHeight') if not maximized and not minimized

		style =
			maxWidth: blockWidth + 'px'
			maxHeight: blockHeight + 'px'

		images.css style


	###
        set default img max dimensions
	###
	window.onload = ->
		$('.block').trigger 'resize'

	###
        maximize block
	###
	maximize = ($block) ->
		$jcarouselContainer = $block.find('.jcarousel-container')
		$tools = $block.find('.tools')
		$restoreIcon = $block.find('.restore-icon')

		style =
			position: 'fixed'
			top: 0
			left: 0
			width: '100%'
			height: '100%'
			'z-index': 3

		$block.removeAttr('style').css style
		$block.removeClass 'minimized'
		$block.addClass 'maximized'
		$jcarouselContainer.show()
		$tools.hide()
		$restoreIcon.show()
		$block.trigger 'resize'

	###
        minimize block
	###
	minimizeAll = ($blocks) ->
		$blocks.each (i) ->
			$jcarouselContainer = $(@).find('.jcarousel-container')
			$tools = $(@).find '.tools'
			$restoreIcon = $(@).find '.restore-icon'

			rightPosition = 100 + i*110

			style =
				position: 'fixed'
				width: '100px'
				height: '100px'
				top: 'auto'
				left: 'auto'
				bottom: '50px'
				right: rightPosition + 'px'

			$(@).removeAttr('style').css style
			$(@).removeClass 'maximized'
			$(@).addClass 'minimized'
			$jcarouselContainer.hide()
			$tools.show()
			$restoreIcon.hide()
			$(@).trigger 'resize'

	###
        restore default position
	###
	restoreAll = ->
		$('.block').each ->
			style = $(@).data 'style'
			$tools = $(@).find '.tools'
			$restoreIcon = $(@).find '.restore-icon'
			$jcarouselContainer = $(@).find '.jcarousel-container'

			$(@).removeAttr('style').attr 'style', style
			$(@).removeClass 'maximized minimized'
			$tools.show()
			$restoreIcon.hide()
			$jcarouselContainer.show()
			$(@).trigger 'resize'

	###
        hide block
	###
	close = ($block) ->
		$block.hide()
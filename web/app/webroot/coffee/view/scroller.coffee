$ ->
	$li = $('.jcarousel li')
	$jcarousels = $('.jcarousel')
	$jcarouselContainers = $('.jcarousel-container')
	$blocks = $('.block')

	$jcarousels.jcarousel
		vertical: 'true'


	###
        click on li
    ###
	$li.click ->
		time = $(@).data 'start'
		root.pop.jumpTo time

	###
        highlight thumbnail
        set it in the middle of scroller
    ###
	$li.on 'timeupdate', (event, time) ->
		start = $(@).data 'start'
		end = $(@).data 'end'
		time = Math.floor time
		if time >= start and time < end

			$(@).addClass 'active' if not $(@).hasClass 'active'

			$jcarousel = $(@).closest '.jcarousel'
			$jcarouselContainer = $jcarousel.closest '.jcarousel-container'
			mouseenter = $jcarousel.data 'mouseenter'
			fullyVisible = $jcarousel.jcarousel 'fullyvisible'
			fullyVisibleCount = fullyVisible.length

			aboveElementsCount = Math.ceil(fullyVisibleCount / 2) - 1
			currentIndex = $(@).index()
			indexShouldBeOnTop = currentIndex - aboveElementsCount
			indexShouldBeOnTop = currentIndex if indexShouldBeOnTop < 0

			liWillBeOnTop = $jcarousel.find 'li:eq(' + indexShouldBeOnTop + ')'
			finalTopPosition = liWillBeOnTop.position().top
			curentTopPosition = $jcarouselContainer.scrollTop()

			isCorrectPosition = finalTopPosition is curentTopPosition
			isScrolling = $jcarouselContainer.data 'scrolling'

			if not mouseenter and not isScrolling and not isCorrectPosition
				$jcarouselContainer.data 'scrolling', true
				$jcarouselContainer.animate
					scrollTop: finalTopPosition
					600
					->
						$jcarouselContainer.data 'scrolling', false

		else
			$(@).removeClass 'active'

	###
        on mouseenter jcarousel
    ###
	$jcarouselContainers.mouseenter ->
		$(@).find('.jcarousel').data 'mouseenter', true

	###
        on mouseleave jcarousel
    ###
	$jcarouselContainers.mouseleave ->
		$(@).find('.jcarousel').data 'mouseenter', false
		hideScroller $(@)

	###
        toggles jcarousel-container visibility
    ###
	$blocks.mousemove (e) ->
		blockWidth = $(@).width()
		blockOffsetLeft = $(@).offset().left
		blockRightBorder = blockWidth + blockOffsetLeft

		$jcarouselContainer = $(@).find('.jcarousel-container')
		scrollerTotalWidth = $jcarouselContainer.outerWidth true
		triggerRange = scrollerTotalWidth / 2

		visible = $jcarouselContainer.data 'visible'
		isVisible = visible? and visible is true
		animating = $jcarouselContainer.data 'animating'
		isAnimating = animating? and animating is true

		if e.pageX >= blockRightBorder - triggerRange and not isVisible and not isAnimating
			showScroller $jcarouselContainer

		else if e.pageX < blockRightBorder - scrollerTotalWidth and not isAnimating and isVisible
			hideScroller $jcarouselContainer

	###
        show scroller - jcarousel container
    ###
	showScroller = ($jcarouselContainer) ->
		$jcarouselContainer.data 'animating', true
		$jcarouselContainer.animate right: 0, ->
			$(@).data 'visible', true
			$(@).data 'animating', false

	###
        hide scroller - jcarousel container
    ###
	hideScroller = ($jcarouselContainer) ->
		scrollerTotalWidth = $jcarouselContainer.outerWidth true
		$jcarouselContainer.data 'animating', true
		$jcarouselContainer.animate right: -scrollerTotalWidth, ->
			$(@).data 'animating', false
			$(@).data 'visible', false

	###
        mousewheel on scroller dont scroll page
	###
	$jcarouselContainers.bind 'mousewheel DOMMouseScroll', (e) ->
		scrollTo = null

		if (e.type is 'mousewheel')
			scrollTo = (e.originalEvent.wheelDelta * -1)
		else if (e.type is 'DOMMouseScroll')
			scrollTo = 40 * e.originalEvent.detail

		if scrollTo
			e.preventDefault()
			$(this).scrollTop scrollTo + $(this).scrollTop()
#			scrolling -scrollTo

	###
		scrolling scroller with mousewheel
        forbid scroll outside of ul range
	###
#	scrolling = (px) ->
#		$curentScroller = $jcarousels.filter ->
#			$(@).data('mouseenter') is true
#
#		$ul = $curentScroller.find 'ul'
#
#		currentTop = parseInt $ul.css('top').slice(0, -2)
#		adjustedTop = currentTop + px
#		adjustedTop = 0 if adjustedTop > 0
#
#		visibleUlHeight = $curentScroller.height()
#		totalUlHeight = 0
#		$ul.children().each ->
#			totalUlHeight += $(@).outerHeight true
#
#		adjustedTop = -totalUlHeight + visibleUlHeight if adjustedTop - visibleUlHeight < -totalUlHeight

#		$ul.css 'top', adjustedTop + 'px'
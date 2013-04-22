$ ->

	$chapter = $('.chapter')

	###
        handle click chapter
    ###
	$chapter.click (event) ->
		event.preventDefault()
		time = $(@).data 'start'
		root.pop.jumpTo(time)

	###
        set active chapter link if it's in correct chapter time
	###
	$chapter.on 'timeupdate', (event, time) ->
		start = $(@).data 'start'
		end = $(@).data 'end'
		time = Math.floor time
		if time >= start and time < end
			$(@).addClass 'active' if not $(@).hasClass 'active'
		else
			$(@).removeClass 'active'
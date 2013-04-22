class Pop

	popcorn: null

	constructor: (@url) ->
		@popcorn = new Popcorn.smart ".masterVideo", @url

	###
		adds popcorn elements based on timestamps and type
	###
	addPopcornElements: (blocks) ->
		for block in blocks
			if block.target isnt 'masterVideo'

				for timestamp in block.Timestamp
					switch timestamp.Attachment.Type.name
						when 'video'
							@addPopcornVideo timestamp
						when 'image'
							@addPopcornImage timestamp
						when 'text'
							@addPopcornText timestamp

	###
        add popcorn video
	###
	addPopcornVideo: (timestamp) ->
		console.log 'video'

	###
        add popcorn image
	###
	addPopcornImage: (timestamp) ->
		@popcorn.image
			start: timestamp.start
			end: timestamp.end
			src: app.url + timestamp.Attachment.url
			target: 'popcorn-container' + timestamp.block_id

	###
		add popcorn text
	###
	addPopcornText: (timestamp) ->
		@popcorn.footnote
			start: timestamp.start
			end: timestamp.end
			text: timestamp.Attachment.text
			target: 'popcorn-container' + timestamp.block_id

	###
		set video time at
		add active class to link
	###
	jumpTo: (time) ->
		adjustedTime = if time is 0 then 1 else time
		@popcorn.currentTime(adjustedTime)

	###
        on timeupdate
	###
	onTimeUpdate: ->
		_this = @
		@popcorn.on 'timeupdate', ->
			currentTime = _this.popcorn.currentTime()
			$('.chapter').trigger 'timeupdate', currentTime
			$('.jcarousel li').trigger 'timeupdate', currentTime
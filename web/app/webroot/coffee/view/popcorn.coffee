class Pop

	popcorn: null
	duration: null

	constructor: (@url) ->
		@popcorn = new Popcorn.smart ".masterVideo", @url

	###
		adds popcorn elements based on timestamps and type
	###
	addPopcornElements: (blocks) ->
		for block in blocks
#			if block.target isnt 'masterVideo'
			if not block.master

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
		console.log 'here should be addPopcornVideo implementation'

	###
        add popcorn image
	###
	addPopcornImage: (timestamp) ->
		blockId =  timestamp.blockCid ? timestamp.block_id
		@popcorn.image
			start: timestamp.start
			end: timestamp.end
			src: app.url + timestamp.Attachment.url
			target: 'popcorn-container' + blockId

	###
		add popcorn text
	###
	addPopcornText: (timestamp) ->
		blockId =  timestamp.blockCid ? timestamp.block_id
		@popcorn.footnote
			start: timestamp.start
			end: timestamp.end
			text: timestamp.Attachment.text
			target: 'popcorn-container' + blockId

	###
		set video time at
		add active class to link
	###
	jumpTo: (time) ->
		time = 1 if time is 0
		@popcorn.currentTime(time)

	###
        on timeupdate
	###
	onTimeUpdate: ->
		_this = @
		@popcorn.on 'timeupdate', ->
			currentTime = _this.popcorn.currentTime()
			$('.chapter').trigger 'timeupdate', currentTime
			$('.jcarousel li').trigger 'timeupdate', currentTime


	###
        on timeupdate for editor section
	###
	editorsInit: ->
		@popcorn.on 'timeupdate', =>
			currentTime = @popcorn.currentTime()
			Backbone.Events.trigger 'popcornTimeUpdate', currentTime

		@popcorn.on 'durationchange', =>
			Backbone.Events.trigger 'durationchange'
			@duration = @popcorn.duration()


	###
        get ratio video to timeline
	###
	getRatio: ->
		@duration ?= @popcorn.duration()
		@ratio ?= @duration / 100;
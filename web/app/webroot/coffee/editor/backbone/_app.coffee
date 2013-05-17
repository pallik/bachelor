#	nacitat data, mali by sa zobrazit
#	lesson info, ale aj ostatne bloky a vsetko
#	vlozit do jednotlivych collections

#	new blocks - to bude collections blokov

this.Bachelor.App =

	lessonId: Bachelor.lessonId
	pop: null
	blocksData: null

	Models:
		lesson: null

	Collections:
		blocks: null
		timestamps: null

	Views:
		addButtonsView: null
		blocksView: null
		blocksRowsView: null


	create: ->
		@Models.lesson = new Bachelor.Models.Lesson(id: @lessonId)
		@Models.lesson.bind 'change', @init, @


#	when lesson model fetches data, set it to @data
	init: ->
		@data = @Models.lesson.get 'data'

		@Collections.blocks = new Bachelor.Collections.Blocks()
		@Collections.timestamps = new Bachelor.Collections.Timestamps()

		@Views.blocksRowsView = new Bachelor.Views.BlocksRowsView()
		@Views.blocksView = new Bachelor.Views.BlocksView()
		@Views.addButtonsView = new Bachelor.Views.AddButtonsView()
		@Views.timelineView = new Bachelor.Views.TimelineView()


		@addBlocksToCollection()
		@addTimestampsToCollection()
		@initPopcorn()


	getRelatedData: (model) ->
		@data[model]


	addBlocksToCollection: ->
		@blocksData = @getRelatedData 'Block'
		@Collections.blocks.add @blocksData


	addTimestampsToCollection: ->
		_.each @blocksData, (block) =>
			@Collections.timestamps.add block.Timestamp

		Backbone.Events.trigger 'renderAllTimestamps'


	initPopcorn: ->
		@createPopcornInstance()
		blocks = @getRelatedData 'Block'
		@pop.addPopcornElements blocks
		@pop.editorsInit()


	createPopcornInstance: ->
		attachment = @getRelatedData 'Attachment'
		videoUrl = attachment.url
		@pop = new Pop videoUrl

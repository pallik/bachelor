debug = (what) ->
	console.log what


capitalizeFirst = (string) ->
	string.charAt(0).toUpperCase() + string.slice(1)


adjustBlocksContainerHeight = ->
	divBlocks = $('.blocks')
	maxYposition = 0
	reserve = 50

	$('.block').each ->
		offsetTop = $(@).offset().top
		height = $(@).height()
		positionY = offsetTop + height
		maxYposition = positionY if positionY > maxYposition

	blocksContainerHeight = maxYposition - divBlocks.offset().top
	divBlocks.height blocksContainerHeight + reserve


ajaxPost = (url, data, onSuccess, onError) ->
	$.ajax
		type: "POST"
		url: url
		contentType: 'application/json'
		data: data
		dataType: "json"
		success: onSuccess
		error: onError


getRandomColor = ->
	Colors.current = 0 if Colors.current is Colors.names.length
	Colors.names[Colors.current++]


Colors = {}
Colors.current = 0
Colors.names = [
	"#a52a2a"
	"#0000ff"
	"#008000"
	"#ff0000"
	"#ff00ff"
	"#ffa500"
	"#800080"
	"#ffc0cb"
	"#00ff00"
	"#ffff00"
]
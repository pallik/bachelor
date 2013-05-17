debug = (what) ->
	console.log what


capitalizeFirst = (string) ->
	string.charAt(0).toUpperCase() + string.slice(1)


getRandomColor = ->
	Colors.current = 0 if Colors.current is Colors.names.length
	Colors.names[Colors.current++]


Colors = {}
Colors.current = 0
Colors.names = [
	"#a52a2a"
	"#0000ff"
	"#008000"
	"#00ff00"
	"#ff00ff"
	"#ffa500"
	"#ffc0cb"
	"#800080"
	"#800080"
	"#ff0000"
	"#ffff00"
]
root = exports ? this

root.Bachelor =
	Models: {}
	Collections: {}
	Routers: {}
	Views: {}
	lessonId: app.request.params.pass[0]


#$ ->
#
#	$.ajaxPrefilter (options, originalOptions, jqXHR) ->
#		options.url = "#{app.url}/admin#{options.url}"
class Bachelor.Models.Timestamp extends Backbone.Model

	defaults:
		status: true
		start: 0
		end: 0


class Bachelor.Collections.Timestamps extends Backbone.Collection

	model: Bachelor.Models.Timestamp

	url: "#{app.url}/admin/timestamps"

	comparator: (timestamp) ->
		timestamp.get 'start'
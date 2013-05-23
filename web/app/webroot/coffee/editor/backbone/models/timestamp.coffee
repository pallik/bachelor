class Bachelor.Models.Timestamp extends Backbone.Model

	defaults:
		status: false
		timing: false
		highlight: false
		start: 0
		end: 0
		chapter: null
		blockCid: null
		block_id: null


	isSet: ->
		@get 'status'


	setChapterNull: ->
		@set 'chapter', null

class Bachelor.Collections.Timestamps extends Backbone.Collection

	model: Bachelor.Models.Timestamp


	url: "#{app.url}/admin/timestamps"


	comparator: (m1, m2) ->
		status1 = m1.get 'status'
		status2 = m2.get 'status'

		if not status1 and not status2 #false, false
			name1 = parseInt m1.get('Attachment').name
			name2 = parseInt m2.get('Attachment').name
			name1 = 0 if isNaN name1
			name2 = 0 if isNaN name2
			return -1 if name1 < name2
			return 1 if name1 > name2
			return 0

		else if not status1 and status2 #false, true
			return -1

		else if status1 and not status2 #true, false
			return 1

		else if status1 and status2 #true, true
			start1 = parseInt m1.get 'start'
			start2 = parseInt m2.get 'start'
			return -1 if start1 < start2
			return 0 if start1 is start2
			return 1 if start1 > start2

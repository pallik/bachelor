class Bachelor.Models.Attachment extends Backbone.Model

	defaults:
		status: true
		user_id: app.authUser.id


class Bachelor.Collections.Attachments extends Backbone.Collection

	model: Bachelor.Models.Attachment

	url: "#{app.url}/admin/attachments"
<script type="text/template" id="listAttachments">
	{#{{ html.link('Create text attachment', '#', {'class': 'create-text'}) }}#}
	<br />
	<br />

	<h4>Select attachments to add</h4>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th></th>
			<th>Name</th>
			<th>Type</th>
		</tr>

		<% _.each(list, function(el) { %>
			<tr>
				<td><input type="checkbox" data-id="<%= el.Attachment.id %>" data-type="<%= el.Type.name %>"
				           class="select-attachment" id="select-attachment<%= el.Attachment.id %>"/></td>
				<td>
					<label for="select-attachment<%= el.Attachment.id %>"><%= el.Attachment.name %></label>
				</td>
				<td><%= el.Type.name %></td>
			</tr>
		<% }); %>

	</table>

	<br />
	<h4>Select block</h4>
	<table cellpadding="0" cellspacing="0">
		<% Bachelor.App.Collections.blocks.each(function(block) {
			if (!block.isMasterVideo() && block.get('status')) {
		%>
				<tr>
					<td>
						<input type="radio" name="block" value="<%= block.cid %>"
						       id="select-block<%= block.cid %>" class="select-block" checked="checked" />
					</td>
					<td>
						<label for="select-block<%= block.cid %>">
							<span style="color: <%= block.get('color') %>">Select by color</span>
						</label>
					</td>
				</tr>
			<%  }
		}); %>
	</table>

</script>
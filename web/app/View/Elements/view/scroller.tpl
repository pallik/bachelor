<div class="jcarousel-skin-default jcarousel-container gray-skin" id="jcarousel-container{{ loop.index0 }}"
		data-visible="true" data-animating="false" data-scrolling="false">
	<div class="jcarousel jcarousel-vertical" id="jcarousel{{ loop.index0 }}">
		<ul>
			{% for timestamp in block.Timestamp %}
				<li data-start="{{ timestamp.start }}" data-end="{{ timestamp.end }}">
					{{ layout.getThumbnailForScroller(timestamp) }}
				</li>
			{% endfor %}

			<li><img src="http://static.flickr.com/66/199481236_dc98b5abb3_s.jpg" width="75" height="75" alt=""></li>
			<li><img src="http://static.flickr.com/75/199481072_b4a0d09597_s.jpg" width="75" height="75" alt=""></li>
			{#<li><img src="http://static.flickr.com/57/199481087_33ae73a8de_s.jpg" width="75" height="75" alt=""></li>#}
			{#<li><img src="http://static.flickr.com/77/199481108_4359e6b971_s.jpg" width="75" height="75" alt=""></li>#}
			{#<li><img src="http://static.flickr.com/58/199481143_3c148d9dd3_s.jpg" width="75" height="75" alt=""></li>#}
			{#<li><img src="http://static.flickr.com/72/199481203_ad4cdcf109_s.jpg" width="75" height="75" alt=""></li>#}
			{#<li><img src="http://static.flickr.com/58/199481218_264ce20da0_s.jpg" width="75" height="75" alt=""></li>#}
			{#<li><img src="http://static.flickr.com/69/199481255_fdfe885f87_s.jpg" width="75" height="75" alt=""></li>#}
			{#<li><img src="http://static.flickr.com/60/199480111_87d4cb3e38_s.jpg" width="75" height="75" alt=""></li>#}
			{#<li><img src="http://static.flickr.com/70/229228324_08223b70fa_s.jpg" width="75" height="75" alt=""></li>#}
		</ul>
	</div>
</div>
<% cached "page", $ID, $LastEdited, $ContentLocale %>
<article class="row">
	<header class="large-12 columns">
		<h2>$Title</h2>
	</header>
	<section class="large-12 columns">
		$OpenGraphImage.Lazy('Fill', 600, 200)
		$OpenGraphImage
		$Content
		$Form
	</section>
</article>
<% end_cached %>
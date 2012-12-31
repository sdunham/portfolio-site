<?php
/*
Template Name: Contact
*/
?>

<?php get_header(); ?>
	<section id="contact">
		<div class="lyrics">
			<h1>Drop me a line</h1>
			<p>Ain't no mountain high <span class="note">*</span></p>
			<p>Ain't no valley low <span class="note">&#8224;</span></p>
			<p>Ain't no river wide enough <span class="note">&#8225;</span></p>
			<p>If you need me, call me <span class="note">&sect;</span></p>
			<p>No matter where you are</p>
			<p>No matter how far</p>
			<p>Just call my name</p>
			<p>I'll be there in a hurry <span class="note">||</span></p>
			<p>You don't have to worry</p>
			<br><br>
			<p class="footnote"><span class="note">*</span> Some mountains might be a bit too high</p>
			<p class="footnote"><span class="note">&#8224;</span> Ditto for valleys being too low</p>
			<p class="footnote"><span class="note">&#8225;</span> I don't plan on jumping in any rivers</p>
			<p class="footnote"><span class="note">&sect;</span> Try the form instead of calling</p>
			<p class="footnote"><span class="note">||</span> I probably won't be in that much of a hurry</p>
		</div>
		<div id="contact-form">
			<script type="text/javascript">var host = (("https:" == document.location.protocol) ? "https://secure." : "http://");document.write(unescape("%3Cscript src='" + host + "wufoo.com/scripts/embed/form.js' type='text/javascript'%3E%3C/script%3E"));</script>

			<script type="text/javascript">
				var q7x3k1 = new WufooForm();
				q7x3k1.initialize({
				'userName':'sdunham', 
				'formHash':'q7x3k1', 
				'autoResize':true,
				'height':'517',
				'header':'hide'});
				q7x3k1.display();
			</script>
		</div>
	</section>
<?php get_footer(); ?>
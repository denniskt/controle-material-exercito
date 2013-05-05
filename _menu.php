<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<title>jQuery Simple Drop Down Menu v0.25</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<style type="text/css">
	
	/* common page styles */
	body
	{	background: #6595A3;
		padding: 0 20px}

	.clear
	{	clear: both;
		overflow: hidden;
		height: 0}

	#all
	{	width: 80%;
		min-width: 650px;
		margin: 40px auto 0 auto;
		background: #FCFFED;
		padding: 20px 35px}

	h1
	{	font: 26px tahoma, arial;
		color: #324143}

	p
	{	font: 12px tahoma, arial;
		color: #171F26;
		margin-bottom: 25px}

	a
	{	color: #324143}

	a:hover
	{	color: #7B8D3B}

	#copyright
	{	width: 80%;
		min-width: 650px;
		margin: 0 auto;
		padding: 20px 35px;
		background: #B6C28B;
		font: 12px tahoma, arial;
		color: #324143}

	#copyright a
	{	color: #324143}

	#copyright a:hover
	{	color: #171F26}
	</style>
	
</head>
<body>
<div id="all">

<h1>jQuery Simple Drop Down Menu v0.25</h1>

<p>Single-level Drop Down Menu based on jQuery library. See the source.</p>

<p><b>See also:</b><br>
<a href="http://javascript-array.com/scripts/multi_level_drop_down_menu/?jsddm">Multi-Level Drop-Down Menu</a><br>
<a href="http://javascript-array.com/scripts/simple_drop_down_menu/?jsddm">Single-Level Menu without jQuery</a></p>

<style type="text/css">
/* menu styles */
#jsddm
{	margin: 0;
	padding: 0}

	#jsddm li
	{	float: left;
		list-style: none;
		font: 12px Tahoma, Arial}

	#jsddm li a
	{	display: block;
		background: #324143;
		padding: 5px 12px;
		text-decoration: none;
		border-right: 1px solid white;
		width: 70px;
		color: #EAFFED;
		white-space: nowrap}

	#jsddm li a:hover
	{	background: #24313C}
		
		#jsddm li ul
		{	margin: 0;
			padding: 0;
			position: absolute;
			visibility: hidden;
			border-top: 1px solid white}
		
			#jsddm li ul li
			{	float: none;
				display: inline}
			
			#jsddm li ul li a
			{	width: auto;
				background: #A9C251;
				color: #24313C}
			
			#jsddm li ul li a:hover
			{	background: #8EA344}
</style>

<!-- script src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js" type="text/javascript"></script -->
<script src="js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
var ddmenuitem      = 0;
function jsddm_open()
{	jsddm_close();
	ddmenuitem = $(this).find('ul').eq(0).css('visibility', 'visible');}
function jsddm_close()
{	if(ddmenuitem) ddmenuitem.css('visibility', 'hidden');}
function jsddm_timer()
{	closetimer = window.setTimeout(jsddm_close, timeout);}
$(document).ready(function()
{	$('#jsddm > li').bind('mouseover', jsddm_open);
	$('#jsddm > li').bind('mouseout',  jsddm_close);});
</script>

<ul id="jsddm">
	<li><a href="#">JavaScript</a>
		<ul>
			<li><a href="#">Drop Down Menu</a></li>
			<li><a href="#">jQuery Plugin</a></li>
			<li><a href="#">Ajax Navigation</a></li>
		</ul>
	</li>
	<li><a href="#">Effect</a>
		<ul>
			<li><a href="#">Slide Effect</a></li>
			<li><a href="#">Fade Effect</a></li>
			<li><a href="#">Opacity Mode</a></li>
			<li><a href="#">Drop Shadow</a></li>
			<li><a href="#">Semitransparent</a></li>
		</ul>
	</li>
	<li><a href="#">Navigation</a></li>
	<li><a href="#">HTML/CSS</a></li>
	<li><a href="#">Help</a></li>
</ul>
<div class="clear"> </div>

<br>

<p>
	<b>Compatibility:</b> IE6+, Firefox 1.5+, Opera 8+, Safari 3+, Chrome 0.2+<br>
	<b>Requirements:</b> jQuery library<br>
	<b>Size:</b> &lt; 1Kb;<br>
	<b>Features:</b> 
	<ul style="font: 12px tahoma, arial; margin:-15px 10px 15px 35px;padding-top:0">
		<li>unordered list as menu structure</li>
		<li>absence of mouse events within html</li>
		<li>timeout effect</li>
	</ul>
	<p><b>License:</b> Free, but please put a link to the <a href="http://javascript-array.com/scripts/jquery_simple_drop_down_menu/">jsddm home page</a> where you want.</p>
</p>

<!-- like button -->
<div style="margin: 0px 0px 10px 20px;z-index:1">
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) {return;}
	  js = d.createElement(s); js.id = id;
	  js.src = "http://connect.facebook.net/en_US/all.js#xfbml=1";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<div class="fb-like" data-href="http://javascript-array.com/scripts/jquery_simple_drop_down_menu/" data-send="false" data-layout="button_count" data-width="250" data-show-faces="false"
	style="margin-bottom:0px"></div>
</div>
<!-- /like button -->

</div>
<div id="copyright">&copy; 2008-2011 <a href="http://Javascript-Array.com/">Javascript-Array.com</div></div>


</body>
</html>
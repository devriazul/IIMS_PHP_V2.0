<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>nyroModal :: Demo</title>
	<link rel="stylesheet" href="styles/nyroModal.css" type="text/css" media="screen" />
	<script type="text/javascript" src="../jquery-1.2.6.pack.js"></script>
	<script type="text/javascript" src="js/jquery.mousewheel.pack.js"></script>
	<script type="text/javascript" src="js/jquery.color.js"></script>
	<script type="text/javascript" src="js/jquery.nyroModal-1.3.0.pack.js"></script>
	<script type="text/javascript">
	//<![CDATA[
	// Demo NyroModal
	$(function() {
		$.nyroModalSettings({
			debug: true,
			processHandler: function(settings) {
				var url = settings.url;
				if (url && url.indexOf('http://www.youtube.com/watch?v=') == 0) {
					$.nyroModalSettings({
						type: 'swf',
						height: 355,
						width: 425,
						url: url.replace(new RegExp("watch\\?v=", "i"), 'v/')
					});
				}
			},
			endShowContent: function(elts, settings) {
				$('.resizeLink', elts.contentWrapper).click(function(e) {
					e.preventDefault();
					$.nyroModalSettings({
						width: Math.random()*1000,
						height: Math.random()*1000
					});
					return false;
				});
				$('.bgLink', elts.contentWrapper).click(function(e) {
					e.preventDefault();
					$.nyroModalSettings({
						bgColor: '#'+parseInt(255*Math.random()).toString(16)+parseInt(255*Math.random()).toString(16)+parseInt(255*Math.random()).toString(16)
					});
					return false;
				});
			},
			endFillContent: function(elts, settings) {
				if (settings.type == 'iframe') {
					var iframe = $('iframe', elts.content);
					if (iframe.attr('src').indexOf(window.location.hostname) > -1) {
						iframe.load(function() {
							var body = iframe.contents().find('body');
							$.nyroModalSettings({
								width: body.width(),
								height: body.height()
							});
						});
					}
				}
			}
		});
		
		$('#manual').click(function(e) {
			e.preventDefault();
			var content = 'Content wrote in JavaScript<br />';
			jQuery.each(jQuery.browser, function(i, val) {
				content+= i + " : " + val+'<br />';
			});
			$.fn.nyroModalManual({
				bgColor: '#3333cc',
				content: content
			});
			return false;
		});
		$('#manual2').click(function(e) {
			e.preventDefault();
			$('#imgFiche').nyroModalManual({
				bgColor: '#cc3333'
			});
			return false;
		});
		$('#myValidForm').submit(function(e) {
			e.preventDefault();
			if ($("#myValidForm :text").val() != '') {
				$('#myValidForm').nyroModalManual();
			} else {
				alert("Enter a value before going to " + $('#myValidForm').attr("action"));
			}
			return false;
		});
		
		function preloadImg(image) {
			var img = new Image();
			img.src = image;
		}
		
		preloadImg('img/ajaxLoader.gif');
		preloadImg('img/prev.gif');
		preloadImg('img/next.gif');
		
	});
	
	// Page enhancement
	$(function() {
		var allPre = $('pre');
		allPre.each(function() {
			var pre = $(this);
			var link = $('<a href="#" class="showCode">Show Code</a>');
			pre.hide().before(link).before('<br />');
			link.click(function(event) {
					event.preventDefault();
					pre.slideToggle('fast');
					return false;
				});
		});
		var shown = false;
		$('#showAllCodes').click(function(event) {
			event.preventDefault();
			if (shown)
				allPre.slideUp('fast');
			else
				allPre.slideDown('fast');
			shown = !shown;
			return false;
		});
	});
	
	//]]>
	</script>
</head>
<body>

<h1>Demos</h1>
<a href="#" id="showAllCodes" class="showCode">Show All Codes</a><br />
<p>
	<a href="demoSent.php" class="nyroModal">Ajax</a><br />
	<a href="demoFlash.php" class="nyroModal">Ajax with Flash</a><br />
	<a href="demoSent.php#test" class="nyroModal">Ajax Filtering Content #test</a><br />
	<a href="demoSent.php#blabla" class="nyroModal">Ajax Filtering Content #blabla</a>
</p>
<pre>
&lt;a href="demoSent.php" class="nyroModal">Ajax&lt;/a>
&lt;a href="demoSent.php#test" class="nyroModal">Ajax Filtering Content #test&lt;/a>
&lt;a href="demoSent.php#blabla" class="nyroModal">Ajax Filtering Content #blabla&lt;/a>
</pre>
<object width="425" height="355" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"><param value="http://www.youtube.com/v/lddUnv1R5y0" name="movie"/><param value="transparent" name="wmode"/><embed width="425" height="355" wmode="transparent" type="application/x-shockwave-flash" src="http://www.youtube.com/v/lddUnv1R5y0"/></object>
<p><a href="demoSent.php" class="nyroModal" rev="modal">Ajax without closing</a></p>
<pre>&lt;a href="demoSent.php" class="nyroModal" rev="modal">Ajax without closing&lt;/a></pre>

<p><a href="img/img2.jpg" class="nyroModal" title="3rd Street Promenade">Image</a></p>
<pre>&lt;a href="img/img2.jpg" class="nyroModal" title="3rd Street Promenade">Image&lt;/a></pre>
	
<p>
	<a href="img/img1.jpg" id="imgFiche" class="nyroModal" title="UCLA" rel="gal">Gallery Img 1</a><br />
	<a href="img/img2.jpg" class="nyroModal" title="3rd Street Promenade by Night" rel="gal">Gallery Img 2</a><br />
	<a href="img/img3.jpg" class="nyroModal" title="Sunset at Santa Monica" rel="gal">Gallery Img 3</a>
</p>
<pre>
&lt;a href="img/img1.jpg" id="imgFiche" class="nyroModal" title="UCLA" rel="gal">Gallery Img 1&lt;/a>
&lt;a href="img/img2.jpg" class="nyroModal" title="3rd Street Promenade by Night" rel="gal">Gallery Img 2&lt;/a>
&lt;a href="img/img3.jpg" class="nyroModal" title="Sunset at Santa Monica" rel="gal">Gallery Img 3&lt;/a>
</pre>

<p><a href="#test" class="nyroModal">DOM Element (hidden div)</a></p>
<div id="test" style="display: none; width: 600px;">
	<a href="demoSent.php" class="nyroModal">Open a new modal</a><br />
	Test
</div>
<pre>
&lt;a href="#test" class="nyroModal">DOM Element (hidden div)&lt;/a>
&lt;div id="test" style="display: none; width: 600px;">
  &lt;a href="demoSent.php" class="nyroModal">Open a new modal&lt;/a>&lt;br />
  Test
&lt;/div>
</pre>

<p><a href="http://www.youtube.com/watch?v=lddUnv1R5y0" class="nyroModal">Youtube Via Process Handler</a></p>
<pre>
&lt;script type="text/javascript">
$(function() {
  $.fn.nyroModal.settings.processHandler = function(settings) {
    var from = settings.from;
    if (from &amp;&amp; from.href &amp;&amp; from.href.indexOf('http://www.youtube.com/watch?v=') == 0) {
      $.nyroModalSettings({
        type: 'swf',
        height: 355,
        width: 425,
        url: from.href.replace(new RegExp("watch\\?v=", "i"), 'v/')
      });
    }
  };
});
&lt;/script>
&lt;a href="http://www.youtube.com/watch?v=lddUnv1R5y0" class="nyroModal">Youtube Via Process Handler&lt;/a>
</pre>

<p>
	<a id="manual" href="#">Manual Call</a><br />
	<a id="manual2" href="#">Manual Call calling through an other link</a>
	<form id="myValidForm" method="post" action="demoSent.php">
		<input type="text" name="wouhou" />
		<input type="submit" value="simple form with validation" />
	</form>
</p>
<pre>
&lt;script type="text/javascript">
$(function() {
  $('#manual').click(function(e) {
    e.preventDefault();
    var content = 'Content wrote in JavaScript&lt;br />';
    jQuery.each(jQuery.browser, function(i, val) {
      content+= i + " : " + val+'&lt;br />';
    });
    $.fn.nyroModalManual({
      bgColor: '#3333cc',
      content: content
    });
    return false;
  });
  $('#manual2').click(function(e) {
    e.preventDefault();
    $('#imgFiche').nyroModalManual({
      bgColor: '#cc3333'
    });
    return false;
  });
  $('#myValidForm').submit(function(e) {
    e.preventDefault();
    if ($("#myValidForm :text").val() != '') {
      $('#myValidForm').nyroModalManual();
    } else {
      alert("Enter a value before going to " + $('#myValidForm').attr("action"));
    }
    return false;
  });
});
&lt;/script>
&lt;a id="manual" href="#">Manual Call&lt;/a>
&lt;a id="manual2" href="#">Manual Call calling through an other link&lt;/a>
&lt;form id="myValidForm" method="post" action="demoSent.php">
  &lt;input type="text" name="wouhou" />
  &lt;input type="submit" value="simple form with validation" />
&lt;/form>
</pre>

<p>
	<a href="http://www.perdu.com/" class="nyroModal">Automatic Iframe via other hostname</a><br />
	<a href="demoIframe.php" target="_blank" class="nyroModal">Automatic Iframe via target=_blank</a>
</p>
<pre>
&lt;a href="http://www.perdu.com/" class="nyroModal">Iframe Automatique via other hostname&lt;/a>
&lt;a href="demoSent.php" target="_blank" class="nyroModal">Iframe Automatique via target=_blank&lt;/a>
</pre>

<p>
	<form method="post" action="demoSent.php" class="nyroModal">
		<input type="text" name="wouhou" />
		<input type="submit" value="simple form"/>
	</form>
	<form method="post" action="demoSent.php#test" class="nyroModal">
		<input type="text" name="wouhou" />
		<input type="submit" value="simple form Filtering Content"/>
	</form>
</p>
<pre>
&lt;form method="post" action="demoSent.php" class="nyroModal">
  &lt;input type="text" name="wouhou" />
  &lt;input type="submit" value="simple form"/>
&lt;/form>
&lt;form method="post" action="demoSent.php#test" class="nyroModal">
  &lt;input type="text" name="wouhou" />
  &lt;input type="submit" value="simple form Filtering Content"/>
&lt;/form>
</pre>

<p>
	<form method="post" enctype="multipart/form-data" action="demoSent.php" class="nyroModal">
		<input type="file" name="file" />
		<input type="submit" value="form with file"/>
	</form>
	<form method="post" enctype="multipart/form-data" action="demoSent.php#blabla" class="nyroModal">
		<input type="file" name="file" />
		<input type="submit" value="form with file Filtering Content"/>
	</form>
</p>
<pre>
&lt;form method="post" enctype="multipart/form-data" action="demoSent.php" class="nyroModal">
  &lt;input type="file" name="file" />
  &lt;input type="submit" value="form with file"/>
&lt;/form>
&lt;form method="post" enctype="multipart/form-data" action="demoSent.php#blabla" class="nyroModal">
  &lt;input type="file" name="file" />
  &lt;input type="submit" value="form with file Filtering Content"/>
&lt;/form>
</pre>

<p>
	<a href="invalidUrl.php" class="nyroModal">Non existent URL</a><br />
	<a href="invalidUrl.jpg" class="nyroModal">Non existent Image</a><br />
	<a href="#inexistent" class="nyroModal">Non existent Element ID</a><br />
	<a href="demoSent.php#inexistent" class="nyroModal">Non existent Element ID in Ajax Request</a>
</p>
<pre>
&lt;a href="invalidUrl.php" class="nyroModal">Non existent URL&lt;/a>&lt;br />
&lt;a href="invalidUrl.jpg" class="nyroModal">Non existent Image&lt;/a>&lt;br />
&lt;a href="#inexistent" class="nyroModal">Non existent Element ID&lt;/a>&lt;br />
&lt;a href="demoSent.php#inexistent" class="nyroModal">Non existent Element ID in Ajax Request&lt;/a>
</pre>

<p>Preloading Images is not considered to be a part of the plugin, as you probably need to preload other images for your website.<br />
If you need to do so, you can use this code:</p>
<pre>
&lt;script type="text/javascript">
$(function() {
  function preloadImg(image) {
    var img = new Image();
    img.src = image;
  }

  preloadImg('img/ajaxLoader.gif');
  preloadImg('img/prev.gif');
  preloadImg('img/next.gif');
});
&lt;/script>
</pre>

</body>
</html>
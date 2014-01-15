<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<title>GnarlyMedia - Web Design and Development</title>
	
	<meta name="description" content="GnarlyMedia - Boutique web design &amp; development agency based in Melbourne, Australia" />
	
	<meta name="keywords" content="gnarly,media,gnarlymedia,flash,actionscript,HTML,CSS,PHP,MySQL,online,media,web,develop,developer,designer,website,multimedia,wordpress,joomla,gwt,block" />

    <meta name="author" content="GnarlyMedia">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Le styles -->
    <link href="twitter-bootstrap-full/docs/assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }

      @media (max-width: 980px) {
        /* Enable use of floated navbar text */
        .navbar-text.pull-right {
          float: none;
          padding-left: 5px;
          padding-right: 5px;
        }
      }
    </style>
    <link href="twitter-bootstrap-full/docs/assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link rel="stylesheet/less" href="twitter-bootstrap-full/less/bootstrap.less">
    <link rel="stylesheet/less" href="twitter-bootstrap-full/less/responsive.less">

    <!-- GnarlyMedia less -->
    <link rel="stylesheet/less" href="twitter-bootstrap-full/less/responsive-gnarlymedia.less">

	<!-- GnarlyMedia styles -->    
     <link href="css/style.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="twitter-bootstrap-full/docs/assets/js/html5shiv.js"></script>
    <![endif]-->
		
    <link href="photoswipe/photoswipe.css" rel="stylesheet">

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="images/ico/favicon.png">

	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-39851709-1', 'gnarlymedia.com.au');
	  ga('send', 'pageview');
	</script>
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">GnarlyMedia</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><a href="index.html">Home</a></li>
              <li><a href="websites.html">Websites</a></li>
              <li class="active"><a href="contact.php">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span12">
         
			<div id="wall"><!-- the wall do not edit! -->
			<!-- IMPORTANT! - EDIT PROJECTS FROM HERE DOWN ONLY! - DO NOT EDIT ABOVE THIS LINE -->
			
				<div id="contact" class="box shadow text">
					<h3 class="hidden-phone">Gnarlymedia</h3>
					<p>6 Grant St<br>
				    Fitzroy North VIC 3068</p>
			    <h2 class="hidden-phone"></h2>
					<h3 class="hidden-tablet hidden-desktop">Call Gnarlymedia!</h3>
					<h1 class="btn phone-number hidden-tablet hidden-desktop">0416 227780</h1>
				</div>
			
				<div id="form" class="box shadow text">
					<h3>Email us!</h3>
					<p>&nbsp;</p>
					 <?php
					// IMPORTANT: THIS FORM MUST BE SAVED AS A PHP FILE - USUALLY WITH A .php extension.
					// if your form does not show properly, please read our help pages!
					// you MUST include the config.php file before your form
					include 'contact-form/config.php';
				
					// You can edit the form fields below if you like
					// but you must leave intact all parts which are indicated
					// with comments
					?>
					<!-- if you want to use basic JavaScript validation, keep the JS file call below -->
					<script src="contact-form/validation.js"></script>
					<script>// SPECIFY ALL REQUIRED FIELDS AND
					// SEE validation.js for other options
					required.add('fullname', 'NOT_EMPTY');
					required.add('email', 'EMAIL');
					required.add('comments', 'NOT_EMPTY');
					required.add('answer_out', 'NUMERIC');
					</script>
					</h1>
					<form name="fcform2" method="post" action="contact-form/process_form.php" onsubmit="return validate.check()">
					<div>
						<?php
						if(isset($_GET['done'])) {
							echo '<div align="center" style="color:red;font-weight:bold">'.$confirmation_message.'</div><br />';
						}
						?>
						<div class="r">
						<label for="fullname" class="req input_label">Name<em>*</em></label>
						<span class="f">
						<input type="text" name="fullname" id="fullname" onBlur="trim('fullname')" class="input_field">
						</span>
						</div>
					
						<div class="r">
						<label for="email" class="req">Email Address<em>*</em></label>
						<span class="f">
						<input type="text" name="email" id="email" onBlur="trim('email')" class="input_field">
						</span>
						</div>
					
						<div class="r">
						<label for="phone">Phone (optional)</label>
						<span class="f">
						<input type="text" name="phone" id="phone" onBlur="trim('phone')" class="input_field">
						</span>
						</div>
					
						<div class="r comment_field">
						<label for="comments" class="req">How can we help?<em>*</em></label>
						<span class="f">
						<textarea name="comments" id="comments" onBlur="trim('comments')" class="input_field"></textarea>
						</span>
						</div>
					
						<!-- the section below MUST remain for the magic to work -->
						<!-- although feel free to change the style / layout -->
						<div class="r">
						<label for="quest" class="req"><?php echo $question; ?> <em>*</em></label>
						<span class="f">
						<input type="text" name="answer_out" size="6" id="answer_out" onBlur="trim('answer_out')" class="input_field">
						</span>
						</div>
						<!-- section above must remain -->
					
						<div class="sp">&nbsp;</div>
						<p>
							<input class="btn" type="submit" value="Submit">
						</p>
						<div class="sp">&nbsp;</div>
						<p>All fields marked with <em>*</em> are required.</p>
						</div>
					
						<!-- the 2 hidden fields below must REMAIN for the magic to work -->
								<input type="hidden" name="answer_p" value="<?php echo $answer_pass; ?>">
								<input type="hidden" name="enc" value="<?php echo $enc; ?>">
						<!-- above 2 hidden fields MUST remain -->
					</form>
				</div>
				
				<div class="box html-css-javascript-jquery seo-analytics-adwords">
					<a href="images/large/DrumSchool.jpg" title="Nov 2007. Designed and developed with HTML, CSS, and SEO."><img alt="Drum School" src="images/thumbs/DrumSchool.jpg" /></a>
				</div>
				
				<div class="box php-mysql flash wordpress-social-integration jquery seo-analytics-adwords social-integration">
					<a href="images/large/corelandscapes.com.au.jpg" title="[Click to view, Esc to close] - Jun 2012. Developed with Wordpress, PHP, Flash, jQuery mobile, SEO social integration, Javascript"><img alt="Core Landscapes" src="images/thumbs/corelandscapes.com.au.jpg" /></a>
				</div>
			
		<!-- EDIT PROJECTS FROM HERE UP ONLY! - DO NOT EDIT BELOW THIS LINE -->
			</div><!-- end wall -->		 
		 
        </div><!--/span-->
      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; GnarlyMedia 2013 - Melbourne, Australia</p>
      </footer>

    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	<script src="less/less-1.3.3.min.js"></script>

	<script src="modernizr/modernizr.custom.53018.js"></script>

	<script src="js/main.js"></script>
	<script src="js/init.js"></script>
	
	<script src="photoswipe/lib/klass.min.js"></script>
	<script src="photoswipe/code.photoswipe-3.0.5.min.js"></script>

	<!-- Google Code for Call on-site 1 Conversion Page
	In your html page, add the snippet and call
	goog_report_conversion when someone clicks on the
	phone number link or button. -->
	<script type="text/javascript">
	  /* <![CDATA[ */
	  goog_snippet_vars = function() {
	    var w = window;
	    w.google_conversion_id = 1000171762;
	    w.google_conversion_label = "uYinCIaPvQQQ8tH13AM";
	    w.google_conversion_value = 1;
	  }
	  // DO NOT CHANGE THE CODE BELOW.
	  goog_report_conversion = function(url) {
	    goog_snippet_vars();
	    window.google_conversion_format = "3";
	    window.google_is_call = true;
	    var opt = new Object();
	    opt.onload_callback = function() {
	    if (typeof(url) != 'undefined') {
	      window.location = url;
	    }
	  }
	  var conv_handler = window['google_trackConversion'];
	  if (typeof(conv_handler) == 'function') {
	    conv_handler(opt);
	  }
	}
	/* ]]> */
	</script>
	<script type="text/javascript"
	  src="http://www.googleadservices.com/pagead/conversion_async.js">
	</script>
  </body>
</html>

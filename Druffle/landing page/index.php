<?php include_once('validate.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta charset=utf-8>
<title>Druffle</title>

<meta name="description" content="A new social networking club for college students where two groups of friends,3 girls & 3 guys meet over a hangout.">

<link rel="author" href="https://www.google.com/+navaltharun"/>

<link rel="shortcut icon" href="images/icon1.ico" />
<link rel="stylesheet" href="css/landing.css" />

</head>

<body>
<div id='image'></div>
<img id='druf' src="images/druffle.png" />
<div id='title'>Hold tight, We are launching soon!</div>
<div id='subtitle'> A new social networking club for college students where two groups of friends,<br /><span style='margin-left:-20px;'>3 girls & 3 guys meet over a hangout</span>.<br />
<span style='margin-left:-20px;'>Subscribe to stay updated.</span>
</div>

<div id="play"><svg class='light' xmlns="http://www.w3.org/2000/svg" version="1.1" width="100" height="100">
	<circle class='bulb' cx="50" cy="50" r="48" stroke="white" stroke-width="3" fill-opacity="0.6"/>
	<polygon points="85,50 30,80 30,20" fill="white"/>
</svg></div>
<div id='inpt'>
<form id='dru_form'  method="get" action= "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> " >
<input id='email'  type="email" name="email" placeholder=" Email ID" spellcheck="false" value="<?php echo $email;?>">
<input id='insti' type="text" name="insti" placeholder=" Institute" spellcheck="false" value="<?php echo $insti;?>">
<input class='butt' type="submit" name='save' value="SUBMIT">
</form>
</div>
<div id='blur'>

<iframe id='vid1' width="560" height="315" src="//www.youtube.com/embed/VW-htpjUAqk?enablejsapi=1&theme=light&showinfo=0" frameborder="0" ></iframe>
</div>
<div id='popup'><p>Thank you.<br /> We will keep you updated.</p></div>
<div id='footer'>
</div>
</body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="landing.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-53538109-1', 'auto');
  ga('send', 'pageview');

</script>
</html>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Footer</title>
	<link rel="stylesheet" type="text/css" href="/employeeexpensetrackingsystem/footercss.css">

</head>
<body>

	<footer>
        <p>&copy; 2023 Nepal Administrative Staff College. All rights reserved.</p>
    </footer>
    <script>
window.onscroll = function() {
  myFunction();
};

function myFunction() {
  var footer = document.querySelector('footer');
  var footerHeight = footer.offsetHeight;
  var scrollPosition = window.innerHeight + window.scrollY;

  if (scrollPosition >= document.body.offsetHeight - footerHeight) {
    footer.classList.add('footer-visible');
  } else {
    footer.classList.remove('footer-visible');
  }
}

</script>


</body>
</html>
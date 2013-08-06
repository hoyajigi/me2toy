<html>
<head>
<title></title>
<link rel="stylesheet" type="text/css" href="sample.css">
</head>
<body>

<script type="text/javascript" src="../Gears/gears_init.js"></script>
<script type="text/javascript">
if (!window.google || !google.gears) {
    location.href = "http://gears.google.com/?action=install&message=<your welcome message>" +
                    "&return=<your website url>";
  }

var desktop = google.gears.factory.create('beta.desktop');
alert(desktop.createNotification);
var notification = desktop.createNotification();
notification.title = 'Barbecue on Saturday';
notification.icon = "http://mail.google.com/mail.gif";
notification.subtitle = 'Thu Mar 27 1:25pm - 2:25pm';
notification.description = 'Hey everyone, looks like great weather this ' +
    'weekend so I thought we might get together';
//notification.displayAtTime = new Date(2008, 5, 27, 14, 0, 0);
//notification.displayUntilTime = new Date(2008, 5, 27, 14, 0, 15);
notification.addAction('View', 'http://mail.google.com/view?id=...');
desktop.showNotification(notification);
</script>

</body>
</html>

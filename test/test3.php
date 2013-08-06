<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Loki Javascript API</title>
<script type="text/javascript" src="http://loki.com/plugin/files/loki.js"></script>
<script type="text/javascript">
//<![CDATA[
function load()
{
  var loki = LokiAPI();
  loki.onSuccess = function(location) {document.write(location.latitude+', '+location.longitude+', '+location.house_number+', '+location.street+', '+location.city)}
  loki.onFailure = function(error) {alert(error)}
  loki.setKey('me2toy.hoyajigi.com');
  loki.requestLocation(true,loki.FULL_STREET_ADDRESS_LOOKUP);
}
</script>
</head>
<body onLoad="load();">
</body>
</html>
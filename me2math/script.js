
/* -------------------------------------------------------
Insert text at the current cursor position of a textarea.
-------------------------------------------------------
*/
function insertAtCursor(myField, myValue) {
	if (document.selection) {
		myField.focus();
		sel = document.selection.createRange();
		sel.text = myValue;
	}
	else if (myField.selectionStart || myField.selectionStart == '0') {
		var startPos = myField.selectionStart;
		var endPos = myField.selectionEnd;
		myField.value = myField.value.substring(0, startPos)+ myValue+ myField.value.substring(endPos, myField.value.length);
		myField.selectionStart = startPos + myValue.length;
		myField.selectionEnd = myField.selectionStart;
		myField.focus();
	} else {
		myField.value += myValue;
	}
}


/* -------------------------------------------------------
Encode a url
javascript escape() with added [+ " ' /] escaping
-------------------------------------------------------
*/
function URLencode(sStr) {
return encodeURIComponent(sStr);
}
/* -------------------------------------------------------
Refresh the equation image
-------------------------------------------------------
*/
function EqImageRefresh() {
	var x,y,z;
	if (document.getElementById) {
		x = document.getElementById('latexImage');
		y = document.getElementById('latexCode');
		z = document.getElementById('ZoomStatus');
	} else {
		x = document.all['latexImage'];
		y = document.all['latexCode'];
		z = document.all['ZoomStatus'];
	}
	var imageZoom = parseInt(z.innerHTML);
	if (imageZoom==0) {imageZoom=100;}
	if (isNaN(imageZoom)) {imageZoom=100;}
	z.innerHTML = imageZoom;
	x.setAttribute("src","http://www.sitmo.com/gg/latex/latex2png.2.php?z=" + imageZoom + "&eq=" + URLencode(y.value));
}


/* -------------------------------------------------------
Timer: Schedule image refresh after typing
-------------------------------------------------------
*/
var EqImageRefreshTimer;
function HandleLatexChange() // keyup handler
{
	clearTimeout(EqImageRefreshTimer);						// clear the timer
	EqImageRefreshTimer = setTimeout("EqImageRefresh()", 300);    // renew it
}

/* -------------------------------------------------------
Set the focus to the latex editor
-------------------------------------------------------
*/
function sf() {
document.f.latexCode.focus();
}



function ZoomBigger() {
	var zoomLevels = new Array(40 ,50 ,60 ,70 ,80 ,100 ,120 ,150 ,175 ,200 ,250 ,300);
	var imageZoom;
	var z;
	if (document.getElementById) {
		z = document.getElementById('ZoomStatus');
	} else {
		z = document.all['ZoomStatus'];
	}
	imageZoom = parseInt(z.innerHTML);
	if (isNaN(imageZoom)) {imageZoom=100;}
	if (imageZoom < zoomLevels[0]) {imageZoom = zoomLevels[0];}
	if (imageZoom > zoomLevels[zoomLevels.lenght-1]) {imageZoom = zoomLevels[zoomLevels.lenght-1];}
	for (i = zoomLevels.length-2; i >= 0; --i) {
		if (imageZoom >= zoomLevels[i]) {
			imageZoom = zoomLevels[i+1];
			break;
		}
	}
	z.innerHTML = imageZoom;
	EqImageRefresh();
}

function ZoomSmaller() {
	var zoomLevels = new Array(40 ,50 ,60 ,70 ,80 ,100 ,120 ,150 ,175 ,200 ,250 ,300);
	var imageZoom;
	var z;
	if (document.getElementById) {
		z = document.getElementById('ZoomStatus');
	} else {
		z = document.all['ZoomStatus'];
	}
	imageZoom = parseInt(z.innerHTML);
	if (isNaN(imageZoom)) {imageZoom=100;}
	if (imageZoom < zoomLevels[0]) {imageZoom = zoomLevels[0];}
	if (imageZoom > zoomLevels[zoomLevels.lenght-1]) {imageZoom = zoomLevels[zoomLevels.lenght-1];}
	for (var i=1; i<zoomLevels.length; i++) {
		if (imageZoom <= zoomLevels[i]) {
			imageZoom = zoomLevels[i-1];
			break;
		}
	}
	z.innerHTML = imageZoom;
	EqImageRefresh();
}
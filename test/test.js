function LoadScript(url){
	var head=document.getElementsByTagName('head')[0];
	var script=document.createElement('script');
	script.type='text/javascript';
	script.src=url;
	head.appendChild(script);
}

LoadScript('http://me2toy.hoyajigi.com/syntaxhighlighter/scripts/shCore.js');
LoadScript('http://me2toy.hoyajigi.com/syntaxhighlighter/scripts/shBrushPython.js');
LoadScript('http://me2toy.hoyajigi.com/syntaxhighlighter/scripts/shBrushXml.js');
LoadScript("http://alexgorbatchev.com/pub/sh/current/scripts/shBrushBash.js");
LoadScript('http://alexgorbatchev.com/pub/sh/current/scripts/shBrushCpp.js');
LoadScript('http://alexgorbatchev.com/pub/sh/current/scripts/shBrushCSharp.js');
LoadScript('http://alexgorbatchev.com/pub/sh/current/scripts/shBrushCss.js');
LoadScript('http://alexgorbatchev.com/pub/sh/current/scripts/shBrushDelphi.js');
LoadScript('http://alexgorbatchev.com/pub/sh/current/scripts/shBrushDiff.js');
LoadScript('http://alexgorbatchev.com/pub/sh/current/scripts/shBrushGroovy.js');
LoadScript('http://alexgorbatchev.com/pub/sh/current/scripts/shBrushJava.js');
LoadScript('http://alexgorbatchev.com/pub/sh/current/scripts/shBrushJScript.js');
LoadScript('http://alexgorbatchev.com/pub/sh/current/scripts/shBrushPhp.js');
LoadScript('http://alexgorbatchev.com/pub/sh/current/scripts/shBrushPlain.js');
LoadScript('http://alexgorbatchev.com/pub/sh/current/scripts/shBrushRuby.js');
LoadScript('http://alexgorbatchev.com/pub/sh/current/scripts/shBrushScala.js');
LoadScript('http://alexgorbatchev.com/pub/sh/current/scripts/shBrushSql.js');
LoadScript('http://alexgorbatchev.com/pub/sh/current/scripts/shBrushVb.js');

	
var Timer;

function do1(){
	if(typeof(SyntaxHighlighter) != "undefined"){
		SyntaxHighlighter.config.clipboardSwf = 'http://me2toy.hoyajigi.com/syntaxhighlighter/scripts/clipboard.swf';
		SyntaxHighlighter.all();
		SyntaxHighlighter.highlight();
	}
	else{
		Timer = setTimeout("do1()", 500);
	}
}

Timer = setTimeout("do1()", 500);
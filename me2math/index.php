<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<title>Me2Math</title> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<script src="script.js?<?=time()?>" type="text/javascript"/>
<link rel="stylesheet" type="text/css" href="style.css?<?=time()?>" />
</head> 
<body onLoad=EqImageRefresh();>

<div id="zoomselector">
	<a href='#' onclick='ZoomBigger();'>[+]</a>&nbsp;<span id="ZoomStatus">150</span>%&nbsp;<a href='#' onclick='ZoomSmaller();'>[-]</a>
</div>

<div id='latexCodeWrapper'>
	<textarea name="latexCode" id="latexCode" onfocus="" rows="5" autocomplete="OFF" onkeyup="HandleLatexChange();" onchange="this.onkeyup" onPropertyChange="this.onkeyup" onblur="this.onkeyup" >\alpha\beta\gamma\delta\epsilon\zeta\eta\theta\iota\kappa\lambda\mu\nu\xi\o\pi\rho\sigma\tau\upsilon\phi\chi\psi\omega
\Gamma\Lambda\Sigma\Psi\Delta\Xi\Upsilon\Omega\Theta\Pi\Phi
\Re\Im\aleph\hbar\imath\jmath
\\
\frac{a}{b} a^b a_b \sqrt{a} \sqrt[n]{a} \sum \sum_{a}^{b} \prod \prod_{a}^{b} \int \int_{a}^{b} \int_{-\infty}^{\infty} \oint \mathop {\lim}\limits_{a \to \infty}
\\
+ - \pm \mp * = \div \equiv  \sim \approx \ne \doteq \cong \propto
\forall \exists \neg \vee \wedge \in \ni
\subset \supset \subseteq \supseteq \emptyset
\ldots \nabla \partial \prime \circ   <> \le  \ge \ll \gg
\text{\euro} \mathdollar \mathsterling
\leftarrow \rightarrow \leftrightarrow
\\</textarea>
</div>


<div id='latexImageWrapper'>
	<img name='latexImage' id='latexImage' alt='equation preview' title='equation preview' src='http://www.sitmo.com/gg/latex/img/spacer.gif' border='0' />
</div>

</body> 
</html>
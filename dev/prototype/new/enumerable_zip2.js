/***
 * Excerpted from "Prototype and script.aculo.us",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/cppsu for more book information.
***/
$w('Prototype script.aculo.us Dojo DWR').zip($R(1, 4), function(tuple) {
  return tuple.reverse().join('. ');
})
// -> ['1. Prototype', '2. script.aculo.us', '3. Dojo', '4. DWR']

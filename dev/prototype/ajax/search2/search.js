/***
 * Excerpted from "Prototype and script.aculo.us",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/cppsu for more book information.
***/
function bindForm() {
  $('searchForm').observe('submit', function(e) {
    e.stop();

    new Ajax.Updater('results', this.action, {
      method: 'get', parameters: this.serialize(), evalScripts: true
    });

  });
} // bindForm

document.observe('dom:loaded', bindForm);

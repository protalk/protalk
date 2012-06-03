/*
 *		YUI sandbox to run on main page
 *
 *		@version 1.0.0
 */


YUI({
  groups: {
    protalk: {
      base:  protalk.baseurl,

      modules: {

        'protalk-io': {
          fullpath: "/js/moduleIO.js",
          requires: ["base-build", "io-base", "io-form", "widget", "json-parse"]
        },
        'protalk-panel': {
          fullpath: "/js/modulePanel.js",
          requires: [ "base-build", "panel", "protalk-io", "dd-plugin"]
        }
      }
    }
  },


  combine: true

}).use( 'protalk-io', 'protalk-panel', 'node-event-delegate',   function(Y) {




  var bodyContainer  = Y.one('#bodyContainer');



    // clicks on any speaker image within the container element will cause
    // a modal panel to open displaying the speaker's biosketch

    bodyContainer.delegate('click', function(e) {

      e.preventDefault();
      Y.log(e.currentTarget.getAttribute('href'));


    //retrieve & display relevant form partial from server
    var panel = new Y.ProTalk.Panel({
      panelType: 'dialog',
      panelTitle: 'Speaker Biography',
      getUrl : e.currentTarget.getAttribute('href')
    });

    }, '.speaker');















});
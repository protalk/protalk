/*
 *		YUI sandbox to run on main page
 *
 *		@version 1.0.0
 */


YUI({
  groups: {
    protalk: {
      base:  protalk.baseurl ,

      modules: {

        'protalk-io': {
          fullpath: "/protalk/web/js/moduleIO.js",
          requires: ["base-build", "io-base", "io-form", "widget", "json-parse"]
        },
        'protalk-speaker-panel': {
          fullpath: "/protalk/web/js/moduleSpeakerPanel.js",
          requires: [ "base-build", "panel", "protalk-io", "dd-plugin"]
        }
      }
    }
  },


  combine: true

}).use( 'protalk-io', 'protalk-speaker-panel', 'node-event-delegate',   function(Y) {




  var speakerContainer  = Y.one('#speakers');



    // clicks on any speaker image within the container element will cause
    // a modal panel to open displaying the speaker's biosketch

    speakerContainer.delegate('click', function(e) {

      e.preventDefault();
      Y.log(e.currentTarget.getAttribute('href'));


    //retrieve & display relevant form partial from server
    var panel = new Y.ProTalk.SpeakerPanel({
      panelType: 'dialog',
      panelTitle: 'Speaker Biography',
      getUrl : e.currentTarget.getAttribute('href')
    });

    }, '.speaker');















});
/*
*		@class ProTalk.SpeakerPanel
*		@extends Y.Base
*		@version 0.0.1
*
*/

YUI.add("protalk-speaker-panel", function(Y) {
  Y.log('protalk-speaker-panel is loaded', "info");

  //create a namespace and name as a reference for custom class and assign class to it
  //store namespaced class in local scope variable for use as a 'shortcut' reference in Y.log statements
  var Clazz = Y.namespace("ProTalk").SpeakerPanel = Y.Base.create("protalk-speaker-panel", Y.Base, [], {


    initializer: function (config) {
      Y.log(Clazz.NAME + '::initializer', "info");

      this._panelContent = Y.Node.create('<div id="panel_content"></div>');


      this._panelTitle = config.panelTitle;
      this._getUrl = {
        url : config.getUrl
      };

      this._getResponseNode = {
        responseNode : {
          success : this._panelContent,
          failure : this._panelContent
        }
      };


      this._getConfigure = Y.merge(this._getUrl, this._getResponseNode);


      this._getData = new Y.ProTalk.IO(this._getConfigure);


      var panel = new Y.Panel({
        headerContent: this._panelTitle,
        bodyContent: this._panelContent,
        centered:true,
        modal:true,
        width:400,
        hideOn: [],
        zIndex: 6,
        plugins: [Y.Plugin.Drag],
        buttons: [
        {

          value: "Close",
          action: function(e) {
            e.preventDefault();
            panel.hide();
          },
          section: Y.WidgetStdMod.FOOTER

        }
        ]
      }).render('#panel');
    }
  });
},
"0.0.1",
{
  requires: [
  "base-build",
  "panel",
  "dd-plugin",
  "protalk-io"
  ]
});

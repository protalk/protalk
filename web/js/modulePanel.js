/*
*		@class ProTalk.SpeakerPanel
*		@extends Y.Base
*		@version 0.0.1
*
*/

YUI.add("protalk-panel", function(Y) {
    Y.log('protalk-panel is loaded', "info");

    //create a namespace and name as a reference for custom class and assign class to it
    //store namespaced class in local scope variable for use as a 'shortcut' reference in Y.log statements
    var Clazz = Y.namespace("ProTalk").Panel = Y.Base.create("protalk-panel", Y.Base, [], {

        initializer: function (config) {
            Y.log(Clazz.NAME + '::initializer', "info");

            this._panelContent = Y.Node.create('<div id="panel_content"></div>');
            this._panelType = config.panelType;
            this._panelTitle = config.panelTitle;
            this._updateNode = config.updateNode;
            this._getUrl = {
                url : config.getUrl
            };
            this._getResponseNode = {
                responseNode : {
                    success : this._panelContent,
                    failure : this._panelContent
                }
            };
            this._postResponseNode = {
                responseNode : {
                    success : this._updateNode,
                    failure : this._panelContent
                }
            };


            this._getConfigure = Y.merge(this._getUrl, this._getResponseNode);
            this._getData = new Y.ProTalk.IO(this._getConfigure);

            this._panel = new Y.Panel({
                headerContent: this._panelTitle,
                bodyContent: this._panelContent,
                centered:true,
                modal:true,
                width:400,
                hideOn: [],
                zIndex: 6,
                plugins: [Y.Plugin.Drag]
            }).render('#panel');

            switch(this._panelType)
            {
                case 'form':
                    this._addSaveButton('Save');
                    this._addCloseButton('Cancel');
                    break;
                case 'dialog':
                    this._addCloseButton('OK');
                    break;
            }
        },

        _addCloseButton : function (label) {
            Y.log(Clazz.NAME + '::_addCloseButton', 'info');

            var closeButton = {
                value: label,
                action: Y.bind(function(e) {
                    this._panel.hide();
                    this._panel.destroy();
                    this._panel = null;
                }, this),
                section: Y.WidgetStdMod.FOOTER
            };
            this._panel.addButton(closeButton);
        },

        _addSaveButton : function () {
            Y.log(Clazz.NAME + '::_addSaveButton', 'info');

            var form = Y.one('#form');

            var saveButton = {
                value: 'Save',
                action: Y.bind(function(e) {

                    e.preventDefault();

                    this._config = {
                        setup: {
                            method: "POST",
                            form: {
                                id: form.get('id')
                            }
                        }
                    }

                    this._postUrl = {
                        url : form.get('action')
                    };

                    this._json = {
                        json : true
                    };

                    this._postConfigure = Y.merge(this._config,
                        this._postUrl,
                        this._json,
                        this._postResponseNode);

                    this._postData = new Y.ProTalk.IO(this._postConfigure);

                    //if form successfully validated
                    if (this._postData.get('status') === "success") {
                        this._panel.hide();
                        this._panel.destroy();
                        this._panel = null;
                    }
                }, this),

                section: Y.WidgetStdMod.FOOTER
            };
            this._panel.addButton(saveButton);
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

/*
*		@class ProTalk.IO
*		@extends Y.Base
*		@version 0.0.1
*
*/

YUI.add("protalk-io", function(Y) {

  Y.log('protalk-io is loaded', 'info');
  //create a namespace and class name
  //store namespaced class in local scope variable for use as a 'shortcut' reference in Y.log statements
  var Clazz = Y.namespace("ProTalk").IO = Y.Base.create("protalk-io", Y.Base, [], {

    _request: null,
    _url: null,
    _responseNode: {},
    _config: {},

    initializer: function(config) {
      Y.log(Clazz.NAME + '::initializer', "info");

      this._url = config.url;
      this._responseNode = config.responseNode;

      if (Y.Lang.isValue(config.setup)) {
        this._config = config.setup;
      }

      if (Y.Lang.isValue(config.json)) {
        this._json = config.json;
      } else {
        this._json = false;
      }

      var configure = Y.merge(this._getDefaultConfig(), this._config);
      this._request = Y.io(this._url, configure);

    },

    _getDefaultConfig: function() {
      Y.log(Clazz.NAME + '::_getDefaultConfig', 'info');

      return ({
        on: {
          success: Y.bind(this._handleSuccess, this),
          failure: Y.bind(this._handleFailure, this)
        },
        sync:true
      });
    },

    _handleSuccess: function(id, o, args) {
      Y.log(Clazz.NAME + '::_handleSuccess [id: ' + id + ']', 'info');

      if (o.responseText !== undefined) {
        if(this._json)  {
          this._processJSONResponse(o.responseText);
        } else if (!this._json && this._responseNode.success != undefined) {
          this._processHTMLResponse(o.responseText);
        }
      } else {
        this._processUndefinedResponse(o.responseText);
      }
    },

    _handleFailure: function(id, o, args) {
      Y.log(Clazz.NAME + '::_handleFailure [id: ' + id + ']', 'info');
      if (o.responseText !== undefined)
      {
        var s = "<p>Transaction id: " + o.tId + "<br />";
        s += "HTTP status: " + o.status + "<br />";
        s += "Status code message: " + o.statusText + "</p>";

        this._responseNode.failure.setContent(s);
      }
    },

    _parseJSON: function(rawJSON) {
      Y.log(Clazz.NAME + '::_parseJSON', 'info');

      try {
        Y.log('parsing JSON');
        var data = Y.JSON.parse(rawJSON);
        return data;
      }
      catch (e) {
        Y.log("JSON Parse failed!");
        return false;
      }
    },

    _processJSONResponse: function(responseText) {
      Y.log(Clazz.NAME + '::_processJSONResponse', 'info');

      //parse the JSON responseText to array format
      this._parsedJSON = this._parseJSON(responseText);
      //extract the contents of the 'content' namespace within the parsed JSON
      var response = this._parsedJSON.content;
      //extract the contents of the 'status' namespace within the parsed JSON and
      //save to 'status' ATTRS variable (success or failure expected)
      this.set('status', this._parsedJSON.status);

      //if the status of the server response was 'success'
      if(this.get('status') == "success")  {
        Y.log('Iterating successful response');

        this._responseNode.success.setContent(response);

      //if the status of the server response was 'failure'
      } else {
        Y.log('Iterating unsuccessful response');
        //inject the response item into the 'failure' responseNode
        //(only a single response item and responseNode is expected
        //for server responses with a status of 'failure' or 'forbidden')
        this._responseNode.failure.setContent(response);
      }
    },

    _processHTMLResponse: function(responseText) {
      Y.log(Clazz.NAME + '::_processHTMLResponse', 'info');
      //inject the single item of responseText into the single
      //'success' responseNode
      this._responseNode.success.setContent(responseText);
    },

    _processUndefinedResponse: function(responseText) {
      //inject an error messasge into the single 'failure' responseNode
      this._responseNode.failure.setContent('Error: Server response was "undefined"');
    },

    getStatus: function () {
      Y.log(Clazz.NAME + '::getStatus', 'info');

      return this.get('status');
    }
  }, {
    ATTRS: {
      status: {
        value: null
      }
    }
  });
}, "0.0.1", {
  requires: [
  "io", "base-build", "widget", "node", "json-parse"
  ]
});

/*
*		YUI sandbox to run on home page
*
*		@version 1.0.0
*/

YUI().use( "tabview", 'node-focusmanager', function(Y) {

    //on initial page load, when the dom is ready
    Y.on("domready", function() {
        Y.log("ondomready function", "info");

        var tabview = new Y.TabView({
            srcNode: '#tabControl'
        });

        tabview.render();

        var tabControl = Y.one("#tabControl"),
            tabList = tabControl.one("ul"),
            selectedTabAnchor = tabControl.one(".yui3-tab-selected>a"),
            bGeckoIEWin = ((Y.UA.gecko || Y.UA.ie) && navigator.userAgent.indexOf("Windows") > -1),
            panelMap = {};


        tabControl.addClass("yui-tabview");

        //  Remove the "yui-loading" class from the documentElement
        //  now that the necessary YUI dependencies are loaded and the
        //  tabview has been skinned.

        tabControl.get("ownerDocument").get("documentElement").removeClass("yui-loading");
        Y.one("#tabControl").removeClass("hidden");

        //  Apply the ARIA roles, states and properties

        tabList.setAttrs({
            "aria-labelledby": "tabview-heading",
            role: "tablist"
        });

        tabControl.one("div").set("role", "presentation");

        tabControl.plug(Y.Plugin.NodeFocusManager, {
                descendants: ".yui3-tab>a",
                keys: { next: "down:39", // Right arrow
                        previous: "down:37" },  // Left arrow
                focusClass: {
                    className: "yui-tab-focus",
                    fn: function (node) {
                        return node.get("parentNode");
                    }
                },
                circular: true
            });


        //  If the list of tabs loses focus, set the activeDescendant
        //  attribute to the currently selected tab.

        tabControl.focusManager.after("focusedChange", function (event) {

            if (!event.newVal) {    //  The list of tabs has lost focus
                this.set("activeDescendant", selectedTabAnchor);
            }

        });


        tabControl.all(".yui3-tab>a").each(function (anchor) {

            var sHref = anchor.getAttribute("href", 2),
                sPanelID = sHref.substring(1, sHref.length),
                panel;

            //  Apply the ARIA roles, states and properties to each tab

            anchor.set("role", "tab");
            anchor.get("parentNode").set("role", "presentation");


            //  Remove the "href" attribute from the anchor element to
            //  prevent JAWS and NVDA from reading the value of the "href"
            //  attribute when the anchor is focused

            if (bGeckoIEWin) {
                anchor.removeAttribute("href");
            }

            //  Cache a reference to id of the tab's corresponding panel
            //  element so that it can be made visible when the tab
            //  is clicked.
            panelMap[anchor.get("id")] = sPanelID;


            //  Apply the ARIA roles, states and properties to each panel

            panel = Y.one(("#" + sPanelID));

            panel.setAttrs({
                role: "tabpanel",
                "aria-labelledby": anchor.get("id")
            });

        });


        //  Use the "delegate" custom event to listen for the "click" event
        //  of each tab's <A> element.

        tabControl.delegate("click", function (event) {

            var selectedPanel,
                sID = this.get("id");

            //  Deselect the currently selected tab and hide its
            //  corresponding panel.

            if (selectedTabAnchor) {
                selectedTabAnchor.get("parentNode").removeClass("yui-tab-selected");
                Y.one(("#" + panelMap[selectedTabAnchor.get("id")])).removeClass("yui-tabpanel-selected");
            }

            selectedTabAnchor = this;
            selectedTabAnchor.get("parentNode").addClass("yui-tab-selected");

            selectedPanel = Y.one(("#" + panelMap[sID]));
            selectedPanel.addClass("yui-tabpanel-selected");


            //  Prevent the browser from following the URL specified by the
            //  anchor's "href" attribute when clicked.

            event.preventDefault();

        }, ".yui3-tab>a");


        //  Since the anchor's "href" attribute has been removed, the
        //  element will not fire the click event in Firefox when the
        //  user presses the enter key.  To fix this, dispatch the
        //  "click" event to the anchor when the user presses the
        //  enter key.

        if (bGeckoIEWin) {

            tabControl.delegate("keydown", function (event) {

                if (event.charCode === 13) {
                    this.simulate("click");
                }

            }, ">ul>li>a");

        }


    });

});

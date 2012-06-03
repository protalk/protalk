/*
 *		YUI sandbox to run on main Mouse page
 *
 *		@version 1.0.0
 */


YUI({
    groups: {
        protalk: {
            base:  protalk.baseurl ,

            modules: {
                'protalk-io': {
                    fullpath: "/js/moduleIO.js",
                    requires: ["base-build", "io-base", "io-form", "widget"]
                },
                'protalk-panel': {
                    fullpath: "/js/modulePanel.js",
                    requires: [ "base-build", "panel", "protalk-io", "dd-plugin"]
                }
            }
        }
    },


    combine: true

}).use( 'protalk-io', 'protalk-panel', 'node-event-delegate', 'widget-anim', 'overlay', 'event', 'io-base',  function(Y) {

    var commentBtn = Y.one('#button_add_comment'),
        ratingBtn = Y.one('#button_rate_media');

    commentBtn.on('click', function(e) {

        e.preventDefault();

        var panel = new Y.ProTalk.Panel({
            panelType: 'form',
            panelTitle: 'Enter your comment',
            getUrl : e.currentTarget.getAttribute('href')
        });

    //GIVE THE AUTHOR FIELD FOCUS
    // Y.one('#comment_input').focus();

    });

    var rate = new Y.Overlay({
        srcNode: '#rate_this',
        visible: false
    }).plug(Y.Plugin.WidgetAnim);
    rate.anim.get('animHide').set('duration', 0.01);
    rate.anim.get('animShow').set('duration', 0.3);
    rate.render();

    ratingBtn.on('click', function (e) {

        e.preventDefault();

        rate.set("align", {
            node:"#button_rate_media",
            points:[Y.WidgetPositionAlign.BR, Y.WidgetPositionAlign.TL]
        });
        rate.get("contentBox").removeClass("hidden");
        rate.show();

        rate.get("contentBox").delegate('hover', function(e) {

            var id = e.currentTarget.get('id'),
                myRating = id.charAt(id.length-1),
                stars = Y.all('.star');

            stars.each(function(star) {
                var star_id = star.get('id');
                var rating = star_id.charAt(star_id.length-1);

                if (rating <= myRating) {
                    star.set('src', "/images/star_full.png");
                } else {
                    star.set('src', "/images/star_empty.png");
                }
            });

            stars.on('click', function(e) {

                e.preventDefault();
                var link = e.currentTarget.ancestor();
                var uri = link.getAttribute('href');

                function complete(id, o, args) {
                    Y.log(o.responseText);
                    //TODO: Update the rating node to display the new rating stars
                    //      or display an error msg of some kind
                }

                Y.on('io:complete', complete, Y, ['lorem', 'ipsum']);
                var request = Y.io(uri);
            });

        }, 'img');

        rate.get("contentBox").on('mouseleave', function () {
            rate.hide();
        });
    });
});























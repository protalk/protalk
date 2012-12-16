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
}).use( 'protalk-io', 'protalk-panel', 'node-event-delegate', 'widget-anim', 'overlay', 'event', 'io',  function(Y) {

    var commentsNode    = Y.one('#comments_content'),
    commentBtn = Y.one('#button_add_comment'),
    ratingBtn = Y.one('#button_rate_media'),
    stars = Y.all('.star'),
    starsContainer = Y.one('#rate_this_content');

    starsContainer.delegate('click', function(e) {
        e.preventDefault();
        var target = e.currentTarget
        var url = e.currentTarget.getAttribute('href');
        var config = {
            responseNode : {
                success : Y.one('#rating'),
                failure : Y.one('#rating')
            },
            url : url
        };

        var request = new Y.ProTalk.IO(config);
        rate.hide();
    }, 'a');

    commentBtn.on('click', function(e) {
        e.preventDefault();
        var panel = new Y.ProTalk.Panel({
            panelType: 'form',
            panelTitle: 'Enter your comment',
            updateNode: commentsNode,
            getUrl : e.currentTarget.getAttribute('href')
        });
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
            myRating = id.charAt(id.length-1);
            stars.each(function(star) {
                var star_id = star.get('id');
                var rating = star_id.charAt(star_id.length-1);
                if (rating <= myRating) {
                    star.set('src', "/images/star_full.png");
                } else {
                    star.set('src', "/images/star_empty.png");
                }
            });
        }, 'img');

        rate.get("contentBox").on('mouseleave', function () {
            rate.hide();
        });
    });
});























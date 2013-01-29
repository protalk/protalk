How to use the media type auto-detection system
===============================================

To use the media type system, you simply have to create a new Mediatype
which has the type 'autodetect'.

The system will then automatically detect the correct MediaType adapter to use
based on the URL you place in the `Content` field.


How to add a new media type adapter
-----------------------------------

Each media type has 4 parts:

1. A class `Protalk\MediaBundle\MediaType\<Class>`
2. A view `Protalk\MediaBundle\Resources\views\MediaType\<type>.html.twig
3. A service definition with a tag of `protalk.media_type.provider`, and an alias
4. A test (yes, you should submit a test! :D)


Ideal Implementation
--------------------

I didn't want to be the guy who jumps in and starts changing everything, but if I had an ideal recommendation on how to
implement this system, it would be as follows:

Each media entry gets `video_url` and `slide_url` added to it. Possibly even `video_url_type` and `slide_url_type`
so that the actual resolution could be cached as well.

Then you use this system to render those urls.

This would free up the 'content' section again for arbitrary content to be added.

You could even use twig to render the 'content' field and replace `{{ video }}` and `{{ slides }}` with the output
 of the media type processing of `video_url` and `slide_url` so you could do more complex structuring of the content.

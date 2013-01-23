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



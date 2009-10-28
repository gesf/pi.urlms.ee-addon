This plugin returns a short version of a given URL using urlms.com service API.

###Tag

`{exp:urlms}{/exp:urlms}`

###Parameters

`pointer="foo"`

You can use a custom pointer, instead of the ones automatically generate by urlms.com. E.g: http://urlms.com/foo

`preview="yes|no"`

You can choose whether or not your short URL will instantly redirect to its destination, or a page with information about the destination URL will be shown before redirecting.

###Example

`{exp:urlms}www.expressionengine.com{/exp:urlms}`

Returns: `http://urlms.com/SdH`

`{exp:urlms preview="yes"}www.expressionengine.com{/exp:urlms}`

Returns: `http://urlms.com/mOX`

`{exp:urlms pointer="ellislab"}http://ellislab.com/{/exp:urlms}`

Returns: `http://urlms.com/ellislab`

`{exp:urlms pointer="enginehosting" preview="yes"}http://www.enginehosting.com/{/exp:urlms}`

Returns: `http://urlms.com/enginehosting`

###Requirements

This is a plugin for the [ExpressionEngine](http://expressionengine.com) content management system, and has been tested with ExpressionEngine version 1.6.8.

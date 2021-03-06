
# Configuration

Properties that are planned to be included need to be specified in the ["LocalSettings.php"][mw-localsettings] file using the `$sespgEnabledPropertyList` array. By default the array is empty, i.e. no special property is being annotated to a page.

```php
$sespgEnabledPropertyList = [
	'_EUSER',
	'_CUSER',
	...
];
```
## Property definitions

Property identifiers (see ["definitions.json"](/data/definitions.json) file) are used to specify which of the properties are enabled. An identifier is an internal `ID` which is not to be used during user interaction (e.g. handling in `#ask` queries) instead the property label should be used as reference.

### Labels

Property labels differ according to the language the wiki was set up. An easy way to identify those used labels is to navigate to the "Special:Properies" page that lists all available properties including properties provided by this extension.

### Identifiers

- `_EUSER` adds a property with all users that edited this page (expensive; use with care)
- `_CUSER` adds a property with the user that created this page
- `_REVID` adds a property with current revision ID
- `_PAGEID` adds a property with the page ID
- `_PAGELGTH` adds a property to record the page length
- `_NREV` adds a property showing an estimated number of total revisions of a page
- `_NTREV` same as `_NREV` but for the talk page, i.e. showing how much discussion is going on around this page
- `_SUBP` adds a property with all subpages
- `_USERREG` adds a property to user pages with the users registration date
- `_USEREDITCNT` adds a property to user pages with the users edit count
- `_USERBLOCK` adds a property to user pages with the users block status
- `_USERRIGHT` adds a property to user pages with the users assigned rights
- `_USERGROUP` adds a property to user pages with the users assigned groups
- `_EXIFDATA` adds properties for image metadata (Exif data)

#### Identifiers with further dependencies

- `_SHORTURL` adds short URL if the [ShortUrl][ShortUrl] extension is installed, and there is a shortened URL for the current page
- `_VIEWS` adds a property with number of page views if the [HitCounters][HitCounters] extension is installed. This is required starting with MediaWiki 1.25 and later. In earlier versions of MediaWiki this special property used to work out of the box if enabled. Note that depending on local settings this value might not be very up to date. If [`$wgDisableCounters`][$wgDisableCounters] is set to "true" this property will never be set.
- `_APPROVED` for approvement state collection on pages if the [Approved Revs][Approved Revs] extension is installed
- `_APPROVEDBY` for approving user collection on pages if the [Approved Revs][Approved Revs] extension is installed
- `_APPROVEDDATE` for approved date collection on pages if the [Approved Revs][Approved Revs] extension is installed
- `_APPROVEDSTATUS` for approvement status collection on pages if the [Approved Revs][Approved Revs] extension is installed

## Additional configuration

#### Fixed tables

Setting `$sespgUseFixedTables` to "true" enables to setup properties as [fixed properties][fixedprop] in order to
improve data access. Doing so is recommended. Note that you have to run the ["update.php"][mw-update] maintenance script
from your wiki's base directory after setting this parameter for the required tables to be created.

Running the [data refresh][data-refresh] afterwards is recommended as well and should be done every time a special property
is added to the `$sespgEnabledPropertyList` array.

#### Bot edits

Setting `$sespgExcludeBotEdits` to "true" causes bot edits via user accounts in usergroup "bot" to be ignored when storing
data for the special properties activated. However this does not affect the page creator property (`_CUSER`).

#### Property definitions

Details about available properties can be found in the ["definitions.json"](/data/definitions.json) file. The file also contains information about the visibility (display in the Factbox etc.) of a property, to alter the characterisctics of non-subobject related properties one can set `show` to `true` for each definition.

#### Cache usage

Setting `$sespgLabelCacheVersion` to "false" will cease to use the special property label cache at all. Otherwise this is
used as an internal modifier to allow resetting the cache with an arbitrary version.

## Privacy

Please note that users that are otherwise hidden to some usergroup might be revealed by this extension, as the `_EUSER`
property will list all authors for everyone.

The Exchangeable image file format (and thereof its Exif tags) can contain metadata about a location which can pose
a [privacy issue][privacy].

&larr; [README](README.md) | [Extension](01-extension.md) | [Migration to 2.0.0](migration-to-200.md) &rarr;

[smw]: https://www.semantic-mediawiki.org/wiki/Semantic_MediaWiki
[subobject]: https://semantic-mediawiki.org/wiki/Subobject
[$wgDisableCounters]: https://www.mediawiki.org/wiki/Manual:$wgDisableCounters
[privacy]: https://en.wikipedia.org/wiki/Exchangeable_image_file_format#Privacy_and_security
[mw-testing]: https://www.mediawiki.org/wiki/Manual:PHP_unit_testing
[fixedprop]: https://www.semantic-mediawiki.org/wiki/Help:Fixed_properties
[MIME type]: https://semantic-mediawiki.org/wiki/Help:Special_property_MIME_type
[Media type]: https://semantic-mediawiki.org/wiki/Help:Special_property_Media_type
[ShortUrl]: https://www.mediawiki.org/wiki/Extension:ShortUrl
[HitCounters]: https://www.mediawiki.org/wiki/Extension:HitCounters
[Approved Revs]: https://www.mediawiki.org/wiki/Extension:Approved_Revs
[data-refresh]: https://www.semantic-mediawiki.org/wiki/Help:Maintenance_script_rebuildData.php
[mw-update]: https://www.mediawiki.org/wiki/Manual:Update.php
[mw-localsettings]: https://www.mediawiki.org/wiki/Localsettings
[mw-contentlang]: https://www.mediawiki.org/wiki/Content_language

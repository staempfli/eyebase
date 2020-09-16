# Eyebase

[![Project Status: Abandoned – Initial development has started, but there has not yet been a stable, usable release; the project has been abandoned and the author(s) do not intend on continuing development.](http://www.repostatus.org/badges/latest/abandoned.svg)](http://www.repostatus.org/#abandoned)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/e2a3cf45edfc4b18aebfaaefa610699e)](https://www.codacy.com/app/Staempfli/eyebase?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=staempfli/eyebase&amp;utm_campaign=Badge_Grade)
[![Build Status](https://travis-ci.org/staempfli/eyebase.svg?branch=master)](https://travis-ci.org/staempfli/eyebase)
[![Maintainability](https://api.codeclimate.com/v1/badges/5a81c2e0d57eb6f127ad/maintainability)](https://codeclimate.com/github/staempfli/eyebase/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/5a81c2e0d57eb6f127ad/test_coverage)](https://codeclimate.com/github/staempfli/eyebase/test_coverage)

Library to fetch information from [Eyebase](https://www.eyebase.com/) Api's

```php
$api = new \Staempfli\Eyebase\Api('http://mediasuite2.eyebase.com', 'd4ddf72a62dddf478deabc5a19b244b7');

$version = $api->getApiVersion();
/**
 * Returns a SimpleXMLElement
 *
 *  SimpleXMLElement Object
 *  (
 *      [version] => SimpleXMLElement Object
 *          (
 *              [id] => 1.4.1
 *              [name] => eyebase API v1.4.1
 *          )
 *  )
 */
 
$version = $api->setOutputFormat('json')->getApiVersion();
/**
 * Returns a JSON string
 *
 * {"version":{"id":"1.4.1","name":"eyebase API v1.4.1"}}
 */
 
  
$version = $api->setOutputFormat('array')->getApiVersion();
/**
 * Returns an Array
 * 
 *  Array
 *  (
 *      [version] => Array
 *          (
 *              [id] => 1.4.1
 *              [name] => eyebase API v1.4.1
 *          )
 *  )
 */

// Example
$mediaAssetDetail = $api->setOutputFormat('array')->getMediaAssetDetails(20133);
/**
 * 
 * Array
 *  (
 *     [mediaasset] => Array
 *         (
 *             [item_id] => 20133
 *             [mediaassettype] => 501
 *             [titel] => Dummy DE
 *             [titel_en] => Dummy EN
 *             [original_filename] => dummy.jpg
 *             [beschreibung] => Array
 *                 (
 *                 )
 *
 *             [ordnerstruktur] => Dummy
 *             [copyright] => Array
 *                 (
 *                 )
 *
 *             [field_251] => Standardusergroup, Demo User, Partners
 *             [field_257] => 04. August 2017
 *
 *             [eigentuemer] => Stämpfli AG
 *             [erstellt] => Array
 *                 (
 *                )
 *
 *             [erfasst] => 03.08.2017
 *             [geaendert] => 04.08.2017
 *             [quality_512] => Array
 *                 (
 *                     [resolution_x] => 300
 *                     [resolution_y] => 300
 *                     [resolution_z] => Array
 *                         (
 *                         )
 *
 *                     [size_mb] => 0.01
 *                     [checksum] => 6a6cf9fc1beb493d70eeb195ecad3552e74bd3f3193a8f190dcdbc9e7e8a95be37c9528e
 *                     [filename_ext] => .jpg
 *                     [filename_name_base] => 00020133_w
 *                     [filename] => 00020133_w.jpg
 *                     [url] => http://mediasuite2.eyebase.com/eyebase.data/bilder/512/137/00020133_w.jpg
 *                 )
 *
 *             [quality_1024] => Array
 *                 (
 *                     [resolution_x] => 300
 *                     [resolution_y] => 300
 *                     [resolution_z] => Array
 *                         (
 *                         )
 *
 *                     [size_mb] => 0.11
 *                     [checksum] => 6a6cf9fc1beb493d70eeb195ecad3552e74bd3f3193a8f190dcdbc9e7e8a95be37c9528e
 *                     [filename_ext] => .png
 *                     [filename_name_base] => 00020133_m
 *                     [filename] => 00020133_m.png
 *                     [url] => http://mediasuite2.eyebase.com/eyebase.data/bilder/1024/137/00020133_m.png
 *                 )
 *         )
 *  )
 */


```

Requirements
------------
- PHP >= 7.0.*
- guzzlehttp/guzzle >= 6.3.*


Support
-------
If you have any issues with this extension, open an issue on [GitHub](https://github.com/staempfli/eyebase/issues).

Contribution
------------
Any contribution is highly appreciated. The best way to contribute code is to open a [pull request on GitHub](https://help.github.com/articles/using-pull-requests).

Developer
---------
[Marcel Hauri](https://github.com/mhauri), and all other [contributors](https://github.com/staempfli/eyebase/contributors)

License
-------
[Open Software License ("OSL") v. 3.0](https://opensource.org/licenses/OSL-3.0)

Copyright
---------
(c) 2017, Stämpfli AG

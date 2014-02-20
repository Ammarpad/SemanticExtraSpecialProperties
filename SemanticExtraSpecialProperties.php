<?php

/**
 * Extension SemanticExtraSpecialProperties - Adds some extra special properties to all pages.
 *
 * @link https://github.com/SemanticMediaWiki/SemanticExtraSpecialProperties/blob/master/README.md Documentation
 * @link https://github.com/SemanticMediaWiki/SemanticExtraSpecialProperties/blob/master/CHANGELOG.md Changlog
 * @link https://github.com/SemanticMediaWiki/SemanticExtraSpecialProperties/issues Support
 * @link https://github.com/SemanticMediaWiki/SemanticExtraSpecialProperties Source code
 *
 * @author Leo Wallentin (Rotsee)
 * @author James Hong Kong (Mwjames)
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License 2.0 or later
 */

// Prevent direct entry
if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'Not an entry point.' );
}

// Assure compatibility
if ( version_compare( $GLOBALS['wgVersion'], '1.19', '<' ) ) {
	die( '<b>Error:</b> This version of Semantic Extra Special Properties requires MediaWiki 1.20 or above.' );
}

if ( ! defined( 'SMW_VERSION' ) ) {
	die( '<b>Error:</b> This version of Semantic Extra Special Properties requires <a href="http://semantic-mediawiki.org/wiki/Semantic_MediaWiki">Semantic MediaWiki</a> installed.<br />' );
}

if ( version_compare( SMW_VERSION, '1.7', '<' ) ) {
	die( '<b>Error:</b> This version of Semantic Extra Special Properties requires Semantic MediaWiki 1.7 or above.' );
}

// Define version
define( 'SESP_VERSION', '0.3 alpha' );

// Register extension
$GLOBALS['wgExtensionCredits']['semantic'][] = array(
	'path'           => __FILE__,
	'name'           => 'Semantic Extra Special Properties',
	'author'         => array(
		'[https://github.com/rotsee Leo Wallentin]',
		'[http://xn--ssongsmat-v2a.nu Säsongsmat.nu]',
		'[https://semantic-mediawiki.org/wiki/User:MWJames James Hong Kong]'
	),
	'version'        => SESP_VERSION,
	'url'            => 'https://www.mediawiki.org/wiki/Extension:SemanticExtraSpecialProperties',
	'descriptionmsg' => 'sesp-desc'
);

// Tell file locations
$GLOBALS['wgExtensionMessagesFiles']['SemanticESP'] = __DIR__ . '/SemanticExtraSpecialProperties.i18n.php';

$GLOBALS['wgAutoloadClasses']['SESP'] = __DIR__ . '/src/SESP.php';

// Register hooks
$GLOBALS['wgHooks']['smwInitProperties'][] = 'SESP::sespInitProperties';
$GLOBALS['wgHooks']['SMWStore::updateDataBefore'][] = 'SESP::sespUpdateDataBefore';

<?php
/**
 * Background Images extension.
 *
 * @file
 * @ingroup Extensions
 * @author Ephraim Gregor [http://www.ephraimgregor.com]
 * @copyright © 2015
 * @license MIT
 */

if ( ! defined( 'MEDIAWIKI' ) ) {
	die( 'Not an entry point.' );
}

$wgHooks['ParserFirstCallInit'][] = 'BackgroundImages::setup';
$wgHooks['ParserAfterParse'][] = 'BackgroundImages::replace';

$wgExtensionMessagesFiles['BackgroundImages'] = __DIR__ . '/BackgroundImages.i18n.php';

class BackgroundImages {
	const TAG = 'repl-backgroundImage';

	public static function setup( $parser ) {
		$parser->setFunctionHook( 'backgroundImage', array( 'BackgroundImages', 'insert' ) );
		return true;
	}

	public static function insert( $parser, $title = '' ) {
		$file = wfFindFile( $title );

		if ( false === $file ) {
			return '';
		}

		$url = $file->getUrl();

		$output = self::TAG . ': ( ' . $url . ' );';

		return $parser->insertStripItem( $output );
	}

	public static function replace( $parser, &$text ) {
		if ( false !== strpos( $text, self::TAG ) ) {
			$text = preg_replace( '/' . self::TAG . ': \( (.+) \);/', 'background-image: url( \'$1\' );', $text );
		}
	}
}

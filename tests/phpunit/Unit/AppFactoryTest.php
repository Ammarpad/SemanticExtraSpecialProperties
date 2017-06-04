<?php

namespace SESP\Tests;

use SESP\AppFactory;

/**
 * @covers \SESP\AppFactory
 * @group SESP
 *
 * @license GNU GPL v2+
 * @since 2.0
 *
 * @author mwjames
 */
class AppFactoryTest extends \PHPUnit_Framework_TestCase {

	public function testCanConstruct() {

		$this->assertInstanceOf(
			AppFactory::class,
			new AppFactory()
		);
	}

	public function testCanConstructWikiPage( ) {

		$title = $this->getMockBuilder( '\Title' )
			->disableOriginalConstructor()
			->getMock();

		$instance = new AppFactory();

		$this->assertInstanceOf(
			'\WikiPage',
			$instance->newWikiPage( $title )
		);
	}

	public function testCanConstructWikiPageFrom_NS_MEDIA() {

		$title = \Title::newFromText( 'Foo', NS_MEDIA );

		$instance = new AppFactory();

		$this->assertInstanceOf(
			'\WikiFilePage',
			$instance->newWikiPage( $title )
		);
	}

	public function testCanConstructUserFromTitle( ) {

		$title = $this->getMockBuilder( '\Title' )
			->disableOriginalConstructor()
			->getMock();

		$title->expects( $this->once() )
			->method( 'getText' )
			->will( $this->returnValue( 'Foo' ) );

		$instance = new AppFactory();

		$this->assertInstanceOf(
			'\User',
			$instance->newUserFromTitle( $title )
		);
	}

	public function testCanConstructUserFromID( ) {

		$instance = new AppFactory();

		$this->assertInstanceOf(
			'\User',
			$instance->newUserFromID( 42 )
		);
	}

	public function testGetConnection( ) {

		$connection = $this->getMockBuilder( '\DatabaseBase' )
			->disableOriginalConstructor()
			->getMock();

		$instance = new AppFactory();

		$instance->setConnection(
			$connection
		);

		$this->assertSame(
			$connection,
			$instance->getConnection()
		);
	}

	public function testGetPropertyDefinitions( ) {

		$options = array(
			'sespPropertyDefinitionFile' => '',
			'sespLocalPropertyDefinitions' => array()
		);

		$instance = new AppFactory(
			$options
		);

		$this->assertInstanceOf(
			'\SESP\PropertyDefinitions',
			$instance->getPropertyDefinitions()
		);
	}

	public function testGetLogger( ) {

		$instance = new AppFactory();

		$this->assertInstanceOf(
			'\Psr\Log\LoggerInterface',
			$instance->getLogger()
		);
	}

	public function testGetOption( ) {

		$options = array(
			'Foo' => 'Bar'
		);

		$instance = new AppFactory(
			$options
		);

		$this->assertSame(
			'Bar',
			$instance->getOption( 'Foo' )
		);
	}

}

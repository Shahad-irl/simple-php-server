#!/usr/bin/env php
<?php
use vrDOM\Station\PHPServer\Server; 
use vrDOM\Station\PHPServer\Request;
use vrDOM\Station\PHPServer\Response;

// we never need the first argument
array_shift( $argv );

// the next argument should be the port if not use 80
if ( empty( $argv ) )
{
	$port = 80;
} else {
	$port = array_shift( $argv );
}

require 'vendor/autoload.php';

// create a new server instance
$server = new Server( '127.0.0.1', $port );

// start listening
$server->listen( function( Request $request ) 
{
	return new Response( 'Hello Dude' );
});
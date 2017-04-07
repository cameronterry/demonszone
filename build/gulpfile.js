var gulp = require( 'gulp' ),
	concat = require( 'gulp-concat' ),
	less = require( 'gulp-less' ),
	pump = require( 'pump' ),
	rename = require( 'gulp-rename' ),
	uglify = require( 'gulp-uglify' ),
	util = require( 'gulp-util' );

var destination_path = '../src/';

gulp.task( 'less', function ( callback ) {
	/**
	 * The main CSS output.
	 */
	pump( [
		gulp.src( ['theme.css', 'less/*.less'] ),
		less().on( 'error', util.log ),
		concat( 'style.css' ),
		gulp.dest( destination_path )
	] );

	/**
	 * Embeds CSS output is handled differently and this is to ensure that the
	 * CSS is much smaller. Because if you enabling people to embed your content
	 * on another website, it is beneficial to reduce the overall embed size as
	 * much as possible.
	 */
	pump( [
		gulp.src( ['theme.css', 'less/embeds.less'] ),
		less().on( 'error', util.log ),
		concat( 'embeds.css' ),
		gulp.dest( destination_path )
	], callback );
} );

gulp.task( 'javascript', function ( callback ) {
	pump( [
		gulp.src( ['javascript/zepto.js', 'javascript/unveil.js', 'javascript/dz.js'] ),
		concat( 'dz.js' ),
		gulp.dest( '../src/' ),
		uglify( {
			preserveComments : 'license'
		} ),
		rename( {
			extname: '.min.js'
		} ),
		gulp.dest( destination_path )
	], callback );
} );

gulp.task( 'default', [
	'less', 'javascript'
] );

gulp.task( 'watch', function() {
	gulp.watch( 'less/*', ['less'] );
} );

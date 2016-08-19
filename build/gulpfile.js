var gulp = require( 'gulp' ),
	concat = require( 'gulp-concat' ),
	pump = require( 'pump' ),
	uglify = require( 'gulp-uglify' ),
	rename = require( 'gulp-rename' );

gulp.task( 'jscompress', function ( callback ) {
	pump( [
		gulp.src( ['javascript/zepto.js'] ),
		concat( 'dz.js' ),
		gulp.dest( '../src/' ),
		uglify( {
			preserveComments : 'license'
		} ),
		rename( {
			extname: '.min.js'
		} ),
		gulp.dest( '../src/' )
	], callback );
} );

gulp.task( 'default', [
	'jscompress'
] );

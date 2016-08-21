var gulp = require( 'gulp' ),
	concat = require( 'gulp-concat' ),
	pump = require( 'pump' ),
	uglify = require( 'gulp-uglify' ),
	rename = require( 'gulp-rename' );

var destination_path = '../src/';

gulp.task( 'less', function ( callback ) {
	pump( [
		gulp.src( ['site.less'] ),
		concat( 'style.css' ),
		less(),
		gulp.dest( destination_path )
	] );
} );

gulp.task( 'javascript', function ( callback ) {
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
		gulp.dest( destination_path )
	], callback );
} );

gulp.task( 'default', [
	'jscompress'
] );

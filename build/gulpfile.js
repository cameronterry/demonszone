var gulp = require( 'gulp' ),
	concat = require( 'gulp-concat' ),
	less = require( 'gulp-less' ),
	pump = require( 'pump' ),
	rename = require( 'gulp-rename' ),
	uglify = require( 'gulp-uglify' ),
	util = require( 'gulp-util' );

var destination_path = '../src/';

gulp.task( 'less', function ( callback ) {
	pump( [
		gulp.src( ['less/theme.less', 'less/site.less'] ),
		less().on( 'error', util.log ),
		concat( 'style.css' ),
		gulp.dest( destination_path )
	], callback );
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

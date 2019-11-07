'use strict';

var	gulp						= require('gulp'),
		watch					= require('gulp-watch'),
		prefixer				= require('gulp-autoprefixer'),
		uglify					= require('gulp-uglify'),
		sass					= require('gulp-sass'),
		sourcemaps				= require('gulp-sourcemaps'),
		rigger					= require('gulp-rigger'),
		cleanmin				= require('gulp-clean-css'),
		imagemin				= require('gulp-imagemin'),
		pngquant				= require('imagemin-pngquant'),
		del						= require('del'),
		browserSync				= require('browser-sync'),
		nunjucksRender			= require('gulp-nunjucks-render'),
		plumber					= require('gulp-plumber'),
		notifier     			= require('node-notifier'),
		reload 					= browserSync.reload;

var path = {
	build: {
		html: 'build/',
		js: 'build/js/',
		css: 'build/css/',
		img: 'build/img/',
		fonts: 'build/fonts/',
		libs: 'build/libs/'
	},
	src: {
		root: 'src/',
		html: 'src/*.html',
		js: 'src/js/main.js',
		style: 'src/style/main.scss',
		img: 'src/img/**/*.*',
		fonts: 'src/fonts/**/*.*',
		libs: 'src/libs/**/*.*'
	},
	watch: {
		html: 'src/**/*.html',
		js: 'src/js/**/*.js',
		style: 'src/style/**/*.scss',
		img: 'src/img/**/*.*',
		fonts: 'src/fonts/**/*.*',
        libs: 'src/libs/**/*.*'
	},
	clean: './build'
};

var config = {
	server: {
		baseDir: "./build"
	}
};

gulp.task('html:build', function () {
	gulp.src(path.src.html)
		.pipe(plumber({
			errorHandler: function (err) {
				notifier.notify({
					title: 'HTML compilation error',
					message: err.message
				});
			}
		}))
		.pipe(nunjucksRender({
			path: [path.src.root]
		}))
        .pipe(rigger())
		.pipe(gulp.dest(path.build.html))
		.pipe(reload({stream: true}));
});

gulp.task('js:build', function () {
	gulp.src(path.src.js)
		.pipe(plumber({
			errorHandler: function (err) {
				notifier.notify({
					title: 'JS compilation error',
					message: err.message
				});
			}
		}))
		.pipe(rigger())
		.pipe(sourcemaps.init())
		.pipe(uglify())
		.pipe(sourcemaps.write())
		.pipe(gulp.dest(path.build.js))
		.pipe(reload({stream: true}));
});

gulp.task('style:build', function () {
	gulp.src(path.src.style)
		.pipe(plumber({
			errorHandler: function (err) {
				notifier.notify({
					title: 'SASS compilation error',
					message: err.message
				});
			}
		}))
		.pipe(sourcemaps.init())
		.pipe(sass())
		.pipe(prefixer(['last 4 versions']))
		.pipe(cleanmin())
		.pipe(sourcemaps.write())
		.pipe(gulp.dest(path.build.css))
		.pipe(reload({stream: true}));
});

gulp.task('image:build', function () {
	gulp.src(path.src.img)
		// .pipe(imagemin({
		// 	progressive: true,
		// 	optimizationLevel: 5,
		// 	svgoPlugins: [{removeViewBox: false}],
		// 	use: [pngquant()],
		// 	interlaced: true
		// }))
		.pipe(gulp.dest(path.build.img))
		.pipe(reload({stream: true}));
});

gulp.task('fonts:build', function() {
	gulp.src(path.src.fonts)
		.pipe(gulp.dest(path.build.fonts))
});
gulp.task('libs:build', function() {
    gulp.src(path.src.libs)
        .pipe(gulp.dest(path.build.libs))
});

gulp.task('build', [
	'clean',
	'html:build',
	'js:build',
	'style:build',
	'fonts:build',
    'libs:build',
	'image:build'
]);

gulp.task('watch', function(){
	watch([path.watch.html], function(event, cb) {
		gulp.start('html:build');
	});
	watch([path.watch.style], function(event, cb) {
		gulp.start('style:build');
	});
	watch([path.watch.js], function(event, cb) {
		gulp.start('js:build');
	});
	watch([path.watch.img], function(event, cb) {
		gulp.start('image:build');
	});
	watch([path.watch.fonts], function(event, cb) {
		gulp.start('fonts:build');
	});
    watch([path.watch.libs], function(event, cb) {
        gulp.start('libs:build');
    });
});

gulp.task('webserver', function () {
	browserSync(config);
});

gulp.task('clean', function (cb) {
	return del.sync(path.clean)
});

gulp.task('default', ['build', 'webserver', 'watch']);
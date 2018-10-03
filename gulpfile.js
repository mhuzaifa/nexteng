/* -------------------------------------------------------------------------------------------------

Build Configuration
Contributors: Luan Gjokaj, Adam McKenna, Mehdi Rezaei, Sören Wrede, Saneef Ansari

-------------------------------------------------------------------------------------------------- */
const babel = require('gulp-babel');
const browserSync = require('browser-sync');
const concat = require('gulp-concat');
const connect = require('gulp-connect-php');
const cssnano = require('cssnano');
const cssnext = require('postcss-cssnext');
const del = require('del');
const fs = require('fs');
const gulp = require('gulp');
const gutil = require('gulp-util');
const inject = require('gulp-inject-string');
const partialimport = require('postcss-easy-import');
const plumber = require('gulp-plumber');
const postcss = require('gulp-postcss');
const remoteSrc = require('gulp-remote-src');
const sourcemaps = require('gulp-sourcemaps');
const uglify = require('gulp-uglify');
const unzip = require('gulp-unzip');
const zip = require('gulp-zip');
const imagemin = require('gulp-imagemin');
const clean = require('gulp-clean');
const sass = require('gulp-sass');
const notify      = require('gulp-notify');
const beep        = require('beepbeep');
const pump        = require('pump');

/* -------------------------------------------------------------------------------------------------
Theme Name
-------------------------------------------------------------------------------------------------- */
const themeName = 'Valto';

/* -------------------------------------------------------------------------------------------------
PostCSS Plugins
-------------------------------------------------------------------------------------------------- */
const pluginsDev = [
	partialimport,
	cssnext({
		features: {
			colorHexAlpha: false
		}
	})
];
const pluginsProd = [
	partialimport,
	cssnext({
		features: {
			colorHexAlpha: false
		}
	})
];

/* -------------------------------------------------------------------------------------------------
Header & Footer JavaScript Boundles
-------------------------------------------------------------------------------------------------- */
const headerJS = [
	'node_modules/jquery/dist/jquery.js',
	'node_modules/nprogress/nprogress.js',
	'node_modules/aos/dist/aos.js',
	'node_modules/isotope-layout/dist/isotope.pkgd.js'
];
const footerJS = [
	'src/js/**'
];

/* -------------------------------------------------------------------------------------------------
Installation Tasks
-------------------------------------------------------------------------------------------------- */
gulp.task('default');

gulp.task('cleanup', () => {
	del(['build/**']);
	del(['dist/**']);
});

gulp.task('download-wordpress', () => {
	remoteSrc(['latest.zip'], {
		base: 'https://wordpress.org/'
	})
		.pipe(gulp.dest('build/'));
});

gulp.task('setup', [
	'unzip-wordpress',
	'copy-config'
]);

gulp.task('unzip-wordpress', () => {
	gulp.src('build/latest.zip')
		.pipe(unzip())
		.pipe(gulp.dest('build/'))
});

gulp.task('copy-config', () => {
	gulp.src('wp-config.php')
		.pipe(inject.after('define(\'DB_COLLATE\', \'\');', '\ndefine(\'DISABLE_WP_CRON\', true);'))
		.pipe(inject.after('define(\'DISABLE_WP_CRON\', \'\');', '\ndefine(\'UPLOADS\', "/public/uploads");'))
		.pipe(gulp.dest('build/wordpress'))
		.on('end', () => {
				gutil.beep();
				gutil.log(devServerReady);
				gutil.log(thankYou);
			});
});

gulp.task('disable-cron', () => {
	fs.readFile('build/wordpress/wp-config.php', (err, data) => {
		if (err) {
			gutil.log(wpFy + ' - ' + errorMsg + ' Something went wrong, WP_CRON was not disabled!');
			process.exit(1);
		}
		if (data.indexOf('DISABLE_WP_CRON') >= 0) {
			gutil.log('WP_CRON is already disabled!');
		} else {
			gulp.src('build/wordpress/wp-config.php')
				.pipe(inject.after('define(\'DB_COLLATE\', \'\');', '\ndefine(\'DISABLE_WP_CRON\', true);'))
				.pipe(inject.after('define(\'DISABLE_WP_CRON\', \'\');', '\ndefine(\'UPLOADS\', "/public/uploads");'))
				.pipe(gulp.dest('build/wordpress'));
		}
	});
});

gulp.task('uploads-folder', () => {
	fs.readFile('build/wordpress/wp-config.php', (err, data) => {
		if (err) {
			gutil.log(wpFy + ' - ' + errorMsg + ' Something went wrong, WP_CRON was not disabled!');
			process.exit(1);
		}
		if (data.indexOf('UPLOADS') >= 0) {
			gutil.log('UPLOADS already defined');
		}
		else {
			gulp.src('build/wordpress/wp-config.php')
				.pipe(inject.after('define(\'WP_DEBUG\', false);', '\ndefine(\'UPLOADS\', "/public/uploads");'))
				.pipe(gulp.dest('build/wordpress'));
		}


	});
});



/* -------------------------------------------------------------------------------------------------
Development Tasks
-------------------------------------------------------------------------------------------------- */
gulp.task('build-dev', [
	'copy-theme-dev',
	'copy-fonts-dev',
	'copy-images-dev',
	'copy-videos-dev',
	'copy-audio-dev',
	'copy-3d-dev',
	// 'style-sass-concat',
	'style-dev-concat',
	//'style-dev-concat',
	// 'header-scripts-dev',
	// 'footer-scripts-dev',
	'concat-scripts-dev',
	'concat-vendor-js',
	'plugins-dev',
	'move-modernizr',
	'move-cssbrowserselector',
	'move-jquery',
	'uploads-folder',
	'watch'

], () => {
	connect.server({
		base: 'build/wordpress',
		port: '3020'
	}, () => {
		browserSync({
			proxy: "valto.local"
		});
	});
});

// gulp.task('delete_default_templates', function () {
//     return gulp.src('build/wordpress/wp-content/themes/*', {read: false})
//         .pipe(clean());
// });

gulp.task('copy-theme-dev', () => {
	if (!fs.existsSync('./build')) {
		gutil.log(buildNotFound);
		process.exit(1);
	} else {
		gulp.src('src/theme/**')
			.pipe(gulp.dest('build/wordpress/wp-content/themes/' + themeName));
	}
});

gulp.task('copy-fonts-dev', () => {
	gulp.src('src/assets/fonts/**')
		.pipe(gulp.dest('build/wordpress/public/fonts'))
});

gulp.task('copy-images-dev', () => {
	gulp.src('src/assets/imgs/**')
		.pipe(gulp.dest('build/wordpress/public/imgs'))
});

gulp.task('copy-videos-dev', () => {
	gulp.src('src/assets/video/**')
		.pipe(gulp.dest('build/wordpress/public/video'))
});

gulp.task('copy-audio-dev', () => {
	gulp.src('src/assets/audio/**')
		.pipe(gulp.dest('build/wordpress/public/audio'))
});

gulp.task('copy-3d-dev', () => {
	gulp.src('src/assets/3D/**')
		.pipe(gulp.dest('build/wordpress/public/3D'))
});

//CSS CONCATS
gulp.task('clean-sass', function () {
  return gulp.src('src/sass/style.scss', {read: false})
      .pipe(clean());
});

gulp.task('style-sass-concat', ['clean-sass'], function() {
  return gulp.src([
  	'src/sass/*.scss',
    'src/sass/**/*.scss',
   	'src/components/**/*.scss'
  ])
  .pipe(concat('styles.scss'))
  .pipe(gulp.dest('src/concat'))
});

gulp.task('style-dev', ['style-sass-concat'], function() {
	return gulp.src([
			'src/concat/styles.scss',
		])
		.pipe(plumber({ errorHandler: onError }))
		.pipe(sourcemaps.init())
		.pipe(sass())
		.on('error', onError)
    .pipe(sourcemaps.write('/'))
		.pipe(gulp.dest('build/wordpress/public/scripts'))
		//.pipe(browserSync.stream({ match: '**/*.css' }))
		.pipe(notify({
        title   : 'Gulp Task Complete',
        message : 'SCSS compliled and no errors. Good job!!'
    }));
});


//CSS CONCATS
gulp.task('style-dev-concat', ['style-dev'], function() {
  return gulp.src([
    'build/wordpress/public/scripts/*.css',
    'node_modules/smooth-scrollbar/dist/smooth-scrollbar.css',
    'node_modules/outdated-browser/outdatedbrowser/outdatedbrowser.css'
  ])
  .pipe(sourcemaps.init())
    .pipe(concat('styles.css'))
  .pipe(sourcemaps.write('/'))
  .pipe(gulp.dest('build/wordpress/public/scripts'))
  .pipe(browserSync.reload({stream: true}))
  .pipe(notify({
      title   : 'Gulp Task Complete',
      message : 'Main CSS concat. Good job!!'
  }));
});

// gulp.task('header-scripts-dev', () => {
// 	return gulp.src(headerJS)
// 		.pipe(plumber({ errorHandler: onError }))
// 		.pipe(sourcemaps.init())
// 		.pipe(concat('header-bundle.js'))
// 		.pipe(sourcemaps.write('.'))
// 		.pipe(gulp.dest('build/wordpress/wp-content/themes/' + themeName + '/js'));
// });

// gulp.task('footer-scripts-dev', () => {
// 	return gulp.src(footerJS)
// 		.pipe(plumber({ errorHandler: onError }))
// 		.pipe(sourcemaps.init())
// 		.pipe(babel({
// 			presets: ['env']
// 		}))
// 		.pipe(concat('footer-bundle.js'))
// 		.pipe(sourcemaps.write('.'))
// 		.pipe(gulp.dest('build/wordpress/wp-content/themes/' + themeName + '/js'));
// });

gulp.task('concat-scripts-dev', function() {
  return gulp.src([
    'src/js/*.js',
    'src/components/**/*.js',
    'src/js/views/*.js'
  ])
  .pipe(sourcemaps.init())
    .pipe(concat('main-engine.js'))
  .pipe(sourcemaps.write('/'))
  .pipe(gulp.dest('build/wordpress/public/scripts'))
  .pipe(browserSync.reload({stream: true}))
  .pipe(notify({
      title   : 'Gulp Task Complete',
      message : 'Main Javascript concat. Good job!!'
  }));
});

//VENDORS CONCAT TASK
gulp.task('concat-vendor-js', function() {
  return gulp.src(
    [
      'node_modules/gsap/src/minified/TweenMax.min.js',
      'node_modules/gsap/src/minified/plugins/CSSRulePlugin.min.js',
      'node_modules/gsap/src/minified/utils/Draggable.min.js',
      'node_modules/gsap/src/minified/plugins/ScrollToPlugin.min.js',
      'node_modules/gsap/src/minified/plugins/EndArrayPlugin.min.js',
      'node_modules/cookie_js/cookie.min.js',
      'src/js/defaults/SplitText.min.js',
      'src/js/defaults/MorphSVGPlugin.min.js',
      'src/js/defaults/bodymovin.min.js',
      'src/js/defaults/turf.min.js',
      'node_modules/imagesloaded/imagesloaded.pkgd.min.js',
      'node_modules/fastclick/lib/fastclick.js',
      'node_modules/benmajor-jquery-touch-events/src/jquery.mobile-events.min.js',
      'node_modules/raf/app/requestAnimationFrame.js',
      'node_modules/svg4everybody/lib/svg4everybody.js',
      'node_modules/verge/verge.js',
      'node_modules/viewport-units-buggyfill/viewport-units-buggyfill.js',
      'node_modules/respimage/respimage.min.js',
      'node_modules/smooth-scrollbar/dist/smooth-scrollbar.js',
      'node_modules/outdated-browser/outdatedbrowser/outdatedbrowser.min.js',
      'node_modules/intersection-observer-polyfill/dist/IntersectionObserver.js',
      'node_modules/snapsvg/dist/snap.svg.js',
      'node_modules/easing-js-ii/easing-min.js',
      'node_modules/tippy.js/dist/tippy.all.min.js',
      'node_modules/slick-carousel/slick/slick.js',
      'node_modules/countup.js/dist/countUp.min.js',
      'node_modules/inobounce/inobounce.min.js',
      'node_modules/pizzicato/distr/Pizzicato.min.js',
      'node_modules/three/build/three.min.js',
      'node_modules/jquery-mousewheel/jquery.mousewheel.js',
      'src/js/defaults/mapbox.js',
      'src/js/defaults/burocratik-default.js',
    ])
    .pipe(sourcemaps.init())
      .pipe(concat('buro-workers.js'))
    .pipe(sourcemaps.write('/'))
    .pipe(gulp.dest('build/wordpress/public/scripts'))
    .pipe(notify({
        title   : 'Gulp Task Complete',
        message : 'Buro Workers concat. Good job!!'
    }));
});

//MOVE MODERNIZR
gulp.task('move-modernizr', function(){
  return gulp
    .src('node_modules/Modernizr/modernizr.custom.js')
    .pipe(gulp.dest('build/wordpress/public/scripts'));
})

gulp.task('move-cssbrowserselector', function(){
  return gulp
    .src('src/js/defaults/css_browser_selector.min.js')
    .pipe(gulp.dest('build/wordpress/public/scripts'));
})

gulp.task('move-jquery', function(){
  return gulp
    .src('node_modules/jquery/dist/jquery.min.js')
    .pipe(gulp.dest('build/wordpress/public/scripts'));
})

gulp.task('plugins-dev', () => {
	return gulp.src('src/plugins/**')
		.pipe(gulp.dest('build/wordpress/wp-content/plugins'));
});

gulp.task('reload-js', ['concat-scripts-dev'], (done) => {
	browserSync.reload();
	done();
});

gulp.task('reload-fonts', ['copy-fonts-dev'], (done) => {
	browserSync.reload();
	done();
});

gulp.task('reload-images', ['copy-images-dev'], (done) => {
	browserSync.reload();
	done();
});

gulp.task('reload-videos', ['copy-videos-dev'], (done) => {
	browserSync.reload();
	done();
});

gulp.task('reload-videos', ['copy-audio-dev'], (done) => {
	browserSync.reload();
	done();
});

gulp.task('reload-videos', ['copy-3d-dev'], (done) => {
	browserSync.reload();
	done();
});
gulp.task('reload-theme', ['copy-theme-dev'], (done) => {
	browserSync.reload();
	done();
});

gulp.task('reload-plugins', ['plugins-dev'], (done) => {
	browserSync.reload();
	done();
});

gulp.task('watch', () => {
	gulp.watch(['src/sass/*.scss', 'src/sass/**/*.scss', 'src/components/**/*.scss'], ['style-dev-concat']);
	//gulp.watch(['build/wordpress/public/scripts/*.css'], ['style-dev-concat']);
	gulp.watch(['src/js/*.js', 'src/js/**/*.js', 'src/components/**/*.js'], ['reload-js']);
	gulp.watch(['src/assets/fonts/**'], ['reload-fonts']);
	gulp.watch(['src/assets/images/**'], ['reload-images']);
	gulp.watch(['src/assets/video/**'], ['reload-videos']);
	gulp.watch(['src/theme/**'], ['reload-theme']);
	gulp.watch(['src/plugins/**'], ['reload-plugins']);
	gulp.watch('build/wordpress/wp-config*.php', (event) => {
		if (event.type === 'added') {
			gulp.start('disable-cron');
		}
	})
});

/* -------------------------------------------------------------------------------------------------
Production Tasks
-------------------------------------------------------------------------------------------------- */
gulp.task('build-prod', [
	'copy-theme-prod',
	'copy-fonts-prod',
	'style-prod',
	'header-scripts-prod',
	'footer-scripts-prod',
	'plugins-prod',
	'zip-theme'
]);

gulp.task('copy-theme-prod', () => {
	gulp.src(['src/theme/**', '!src/theme/img/**'])
		.pipe(gulp.dest('dist/themes/' + themeName))
});

gulp.task('copy-fonts-prod', () => {
	gulp.src('src/fonts/**')
		.pipe(gulp.dest('dist/themes/' + themeName + '/fonts'))
});

gulp.task('process-images', ['copy-theme-prod'], () => {
	return gulp.src('src/theme/img/**')
		.pipe(plumber({ errorHandler: onError }))
		.pipe(imagemin([
			imagemin.svgo({ plugins: [{ removeViewBox: true }] })
		], {
			verbose: true
		}))
		.pipe(gulp.dest('dist/themes/' + themeName + '/img'));
});

gulp.task('style-prod', () => {
	return gulp.src('src/style/style.css')
		.pipe(plumber({ errorHandler: onError }))
		.pipe(postcss(pluginsProd))
		.pipe(gulp.dest('dist/themes/' + themeName))
});

gulp.task('header-scripts-prod', () => {
	return gulp.src(headerJS)
		.pipe(plumber({ errorHandler: onError }))
		.pipe(concat('header-bundle.js'))
		.pipe(uglify())
		.pipe(gulp.dest('dist/themes/' + themeName + '/js'));
});

gulp.task('footer-scripts-prod', () => {
	return gulp.src(footerJS)
		.pipe(plumber({ errorHandler: onError }))
		.pipe(babel({
			presets: ['env']
		}))
		.pipe(concat('footer-bundle.js'))
		.pipe(uglify())
		.pipe(gulp.dest('dist/themes/' + themeName + '/js'));
});

gulp.task('plugins-prod', () => {
	return gulp.src('src/plugins/**')
		.pipe(gulp.dest('dist/plugins'));
});

gulp.task('zip-theme', ['copy-theme-prod', 'copy-fonts-prod', 'process-images', 'style-prod', 'header-scripts-prod', 'footer-scripts-prod', 'plugins-prod'], () => {
	gulp.src('dist/themes/' + themeName + '/**')
		.pipe(zip(themeName + '.zip'))
		.pipe(gulp.dest('dist'))
		.on('end', () => {
			gutil.beep();
			gutil.log(pluginsGenerated);
			gutil.log(filesGenerated);
			gutil.log(thankYou);
		});
});

/* -------------------------------------------------------------------------------------------------
Utility Tasks
-------------------------------------------------------------------------------------------------- */
const onError = (err) => {
	gutil.beep();
	gutil.log(wpFy + ' - ' + errorMsg + ' ' + err.toString());
	this.emit('end');
};

const date = new Date().toLocaleDateString('en-GB').replace(/\//g, '.');
const errorMsg = '\x1b[41mError\x1b[0m';
const devServerReady = 'Your development server is ready, start the workflow with the command: $ \x1b[1mnpm run dev\x1b[0m';
const buildNotFound = errorMsg + ' ⚠️　- You need to install WordPress first. Run the command: $ \x1b[1mnpm run install:wordpress\x1b[0m';
const filesGenerated = 'Your ZIP template file was generated in: \x1b[1m' + __dirname + '/dist/' + themeName + '.zip\x1b[0m - ✅';
const pluginsGenerated = 'Plugins are generated in: \x1b[1m' + __dirname + '/dist/plugins/\x1b[0m - ✅';
const backupsGenerated = 'Your backup was generated in: \x1b[1m' + __dirname + '/backups/' + date + '.zip\x1b[0m - ✅';
const wpFy = '\x1b[42m\x1b[1mWordPressify\x1b[0m';
const wpFyUrl = '\x1b[2m - http://www.wordpressify.co/\x1b[0m';
const thankYou = 'Thank you for using ' + wpFy + wpFyUrl;

gulp.task('backup', () => {
	if (!fs.existsSync('./build')) {
		gutil.log(buildNotFound);
		process.exit(1);
	} else {
		gulp.src('build/wordpress/**')
			.pipe(zip(date + '.zip'))
			.pipe(gulp.dest('backups'))
			.on('end', () => {
				gutil.beep();
				gutil.log(backupsGenerated);
				gutil.log(thankYou);
			});
	}
});

/* -------------------------------------------------------------------------------------------------
End of all Tasks
-------------------------------------------------------------------------------------------------- */

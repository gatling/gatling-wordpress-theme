var gulp = require("gulp");

// Utility Plugins
var browserSync = require("browser-sync").create();
var reload = browserSync.reload; //manual reload for task watch
var sourcemaps = require("gulp-sourcemaps"); // Keep track of sass source files when css is displayed.
var rename = require("gulp-rename"); // Rename the files.
var lec = require("gulp-line-ending-corrector"); // Fix different carriage returns between Windows and MAC/linux.
var filter = require("gulp-filter"); // Enables you to work on a subset of the original files by filtering them using globbing.
var del = require("del");

// CSS plugins
var sass = require("gulp-sass"); // Convert SCSS to CSS.
var autoprefixer = require("gulp-autoprefixer"); // Add vendor prefix.
var cleanCSS = require("gulp-clean-css"); // Minify CSS.

// JS plugins
var concat = require("gulp-concat"); //JS Concatenation
var uglify = require("gulp-uglify"); //JS Minify

// Images plugins
var imagemin = require("gulp-imagemin"); // Image optimization.

// Browsers you care about for autoprefixing.
// Browserlist https        ://github.com/ai/browserslist
var AUTOPREFIXER_BROWSERS = ["last 2 versions"];

// CLEAN files for every build
gulp.task("clean", function() {
  return del("./assets/js/");
});

// Add libraries
var paths = {
  wwwroot: {
    lib: "./src/assets/js/vendor"
  },
  lib: [
    "./node_modules/jquery/dist/jquery.js",
    "./node_modules/@fortawesome/fontawesome-free/js/all.js",
    "./node_modules/slick-carousel/slick/slick.js",
    "./node_modules/prismjs/prism.js"
  ]
};

// Add libraries
var csspaths = {
  wwwroot: {
    lib: "./assets/css/vendor"
  },
  lib: [
    "./node_modules/slick-carousel/slick/slick.css",
    "./node_modules/slick-carousel/slick/slick-theme.css",
    "./node_modules/prismjs/themes/prism-okaidia.css"
  ]
};

gulp.task("copy-lib", function() {
  return gulp.src(paths.lib).pipe(gulp.dest(paths.wwwroot.lib));
});

gulp.task("copy-lib-css", function() {
  return gulp.src(csspaths.lib).pipe(gulp.dest(csspaths.wwwroot.lib));
});

// Task 'style' : Transform SCSS to CSS, Minify CSS, Add Sourcemaps, Correct Line ending
//============================================================================
gulp.task("style", function() {
  // Path to main.scss file ('gulp').
  return (
    gulp
      .src("./src/assets/sass/main.scss")
      // Initialize the sourcemap ('gulp-sourcemaps').
      .pipe(sourcemaps.init())
      // Compile SASS to CSS ('gulp-sass').
      .pipe(
        sass({
          outputStyle: "expanded"
          //outputStyle: 'compressed',
          //outputStyle: 'nested',
          //outputStyle: 'compact',
          //indentType: 'tab',
          //indentWidth: '2'
        }).on("error", sass.logError)
      )
      // Add vendor prefixes ('gulp-autoprefixer').
      .pipe(autoprefixer(AUTOPREFIXER_BROWSERS))
      // Write the sourcemap for main.css('gulp-sourcemaps').
      .pipe(sourcemaps.write("./"))
      // Consistent Line Endings for non UNIX systems ('gulp-line-ending-corrector')
      .pipe(lec())
      // Save the processed to folder css ('gulp').
      .pipe(gulp.dest("./assets/css/"))
      // Reloads browser if main.css is enqueued ('browser-sync')
      .pipe(browserSync.stream())

      // Minify the expanded main.css
      // Filtering stream to only css files (not the map !) = Search for .css in the current directory.
      .pipe(filter("**/*.css"))
      // Minify css ('gulp-clean-css').
      .pipe(cleanCSS())
      // Rename with .min ('gulp-rename').
      .pipe(
        rename({
          suffix: ".min"
        })
      )
      // Consistent Line Endings for non UNIX systems ('gulp-line-ending-corrector')
      .pipe(lec())
      // Save the processed to folder css ('gulp').
      .pipe(gulp.dest("./assets/css/"))
      // Reloads browser if main.min.css is enqueued ('browser-sync')
      .pipe(browserSync.stream())
  );
});

// Task: 'js'
//============================================================================
// Task js concat and minify custom js which goes in footer
gulp.task("customJS", function() {
  // Path to custom js source files ('gulp').
  return (
    gulp
      .src("./src/assets/js/custom/*.js")
      // Concat JS with name you choose ('gulp-concat').
      .pipe(concat("main.js"))
      // Consistent Line Endings for non UNIX systems ('gulp-line-ending-corrector')
      .pipe(lec())
      // Save the processed js to folder ('gulp')
      .pipe(gulp.dest("./assets/js/"))
      // Rename with .min ('gulp-rename').
      .pipe(
        rename({
          suffix: ".min"
        })
      )
      // Minify appcustom.js ('gulp-uglify').
      .pipe(uglify())
      // Consistent Line Endings for non UNIX systems ('gulp-line-ending-corrector')
      .pipe(lec())
      // Save the processed js to folder ('gulp')
      .pipe(gulp.dest("./assets/js/"))
  );
});

// Task js minify other js files
gulp.task("vendorJS", function() {
  // Path to other js source files ('gulp').
  return (
    gulp
      .src("./src/assets/js/vendor/*.js")
      // Consistent Line Endings for non UNIX systems ('gulp-line-ending-corrector')
      .pipe(lec())
      // Send js to folder ('gulp')
      .pipe(gulp.dest("./assets/js/"))
      // Rename with .min ('gulp-rename').
      .pipe(
        rename({
          suffix: ".min"
        })
      )
      // Minify JS ('gulp-uglify').
      .pipe(uglify())
      // Consistent Line Endings for non UNIX systems ('gulp-line-ending-corrector')
      .pipe(lec())
      // Save the processed js to folder ('gulp').
      .pipe(gulp.dest("./assets/js/"))
  );
});

gulp.task("js", gulp.series("copy-lib", gulp.parallel("customJS", "vendorJS")));

// TASK 'images' : Minifies PNG, JPEG, GIF and SVG images.
//============================================================================
gulp.task("images", function() {
  return gulp
    .src("./src/assets/img/**/*.{png,jpg,gif,svg}")
    .pipe(
      imagemin({
        progressive: true,
        optimizationLevel: 3, // 0-7 low-high
        interlaced: true,
        svgoPlugins: [{ removeViewBox: false }]
      })
    )
    .pipe(gulp.dest("./assets/img/"));
});

// TASK BUILD : Generate the assets folder in theme.
//==================================================
gulp.task(
  "build",
  gulp.series("clean", gulp.parallel("style", "js", "images"))
);

// TASK Watch : Watch for file during development
gulp.task("watch", function() {
  browserSync.init({
    // For more options
    // @link http://www.browsersync.io/docs/options/

    // Project URL.
    proxy: "http://localhost/gatling" // Change it for your url !!!
  });

  // When a file ending with .scss is modified (even partials), make Task 'Style' Reloading is already inside.
  gulp.watch("./src/assets/sass/**/*.scss", gulp.parallel("style"));
  // Reload the browser when an appcustom JS files is modified.
  gulp.watch("./src/assets/js/custom/*.js", gulp.parallel("js", reload));

  // Reload the browser when a PHP file is modified.
  gulp.watch("./**/*.php").on("change", reload);
});

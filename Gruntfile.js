/* jshint node: true */
module.exports = function(grunt) {
  "use strict";

  // Project configuration.
  grunt.initConfig({
    // Metadata.
    pkg: grunt.file.readJSON('package.json'),
    clean: {
      dist: ['dist']
    },
    jshint: {
      options: {
        jshintrc: 'js/.jshintrc'
      },
      gruntfile: {
        src: 'Gruntfile.js'
      },
      src: {
        src: ['src/js/*.js']
      }
    },
    concat: {
      options: {
        stripBanners: false
      },
      bootstrap: {
        src: [
          'src/js/transition.js',
          'src/js/alert.js',
          'src/js/button.js',
          'src/js/carousel.js',
          'src/js/collapse.js',
          'src/js/dropdown.js',
          'src/js/modal.js',
          'src/js/tooltip.js',
          'src/js/popover.js',
          'src/js/scrollspy.js',
          'src/js/tab.js',
          'src/js/affix.js'
        ],
        dest: 'dist/js/<%= pkg.name %>.js'
      }
    },
    uglify: {
      options: {
        banner: '<%= banner %>'
      },
      bootstrap: {
        src: ['<%= concat.bootstrap.dest %>'],
        dest: 'dist/js/<%= pkg.name %>.min.js'
      }
    },
    less: {
      compileCore: {
        options: {
          strictMath: true,
          sourceMap: true,
          outputSourceFiles: true,
          sourceMapURL: '<%= pkg.name %>.css.map',
          sourceMapFilename: 'dist/css/<%= pkg.name %>.css.map'
        },
        files: {
          'dist/css/bootstrap.css': 'src/less/bootstrap.less'
        }
      },
      compileTheme: {
        options: {
          strictMath: true,
          sourceMap: true,
          outputSourceFiles: true,
          sourceMapURL: '<%= pkg.name %>-theme.css.map',
          sourceMapFilename: 'dist/css/<%= pkg.name %>-theme.css.map'
        },
        files: [
          {'dist/css/<%= pkg.name %>-theme.css': 'src/less/theme.less' },
          {'dist/css/modern-touch-theme.css': 'src/themes/<%= pkg.themes.modernTouch %>' }
        ]
      },
      minify: {
        options: {
          cleancss: true,
          report: 'min'
        },
        files: {
          'dist/css/bootstrap.min.css': 'dist/css/bootstrap.css',
          'dist/css/<%= pkg.name %>-theme.min.css': 'dist/css/<%= pkg.name %>-theme.css'
        }
      }
    },    
    recess: {
      options: {
        compile: true
      },
      bootstrap: {
        src: ['src/less/bootstrap.less'],
        dest: 'dist/css/<%= pkg.name %>.css'
      },
      min: {
        options: {
          compress: true
        },
        src: ['src/less/bootstrap.less'],
        dest: 'dist/css/<%= pkg.name %>.min.css'
      }
    },
    copy: {
      fonts: {
        expand: true,
        cwd: "src/",
        src: ['fonts/*'],
        dest: 'dist/'
      },
      cpanel: {
        expand: true,
        cwd: "src/",
        src: ['*.*'],
        dest: 'dist/'
      }
    },
    connect: {
      server: {
        options: {
          port: 3000,
          base: '.'
        }
      }
    },
    watch: {
      src: {
        files: '<%= jshint.src.src %>',
        tasks: ['jshint:src']
      },
      less: {
        files: 'src/less/*.less',
        tasks: 'less'
      }      
    },
    compress: {
      main: {
        options: {
          archive: 'build/zero_signal.cpbranding.tar.gz',
          mode: 'tgz'
        },  
        expand: true,
        cwd: 'dist/',
        src: ['**/*']
      }
    }    
  });

  // These plugins provide necessary tasks.
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-connect');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-recess');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-compress');

  // JS distribution task.
  grunt.registerTask('dist-js', ['concat', 'uglify']);

  // CSS distribution task.
  grunt.registerTask('dist-css', ['less']);

  // Fonts distribution task.
  grunt.registerTask('dist-fonts', ['copy']);

  // cPanel distribution task.
  grunt.registerTask('dist-cpanel', ['copy']);

  // Full distribution task.
  grunt.registerTask('dist', ['clean', 'dist-css', 'dist-fonts', 'dist-js']);

  // Default task.
  grunt.registerTask('default', ['dist']);
};
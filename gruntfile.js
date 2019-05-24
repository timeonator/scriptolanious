module.exports = function(grunt){
    // configure tasks aand tell plugins where to find certain files
    grunt.initConfig({
        // pass in optionsts plugins, references to files 
        concat: {
            js: {
                src: ['assets/js/*.js'],
                dest: 'build/scripts.js'
            },
            css:{
                src: ['assets/scss/*.css'],
                dest: 'build/styles.css'                
            }
        },
        watch: {
            scripts: {
              files: 'assets/scss/*.scss',
              tasks: ['build-css'],
              options: {
                debounceDelay: 250,
              },
            },
          },
        sass: {
            dist: {
                files: {
                    'public/styles/theme.css':'assets/scss/theme.scss'
                }
              }
        }

    });
// load plugins
grunt.loadNpmTasks('grunt-contrib-concat');
grunt.loadNpmTasks('grunt-contrib-sass');
grunt.loadNpmTasks('grunt-contrib-watch');


// register tasks

grunt.registerTask('concat-js', ['concat:js']);
grunt.registerTask('build-css', ['sass']);

grunt.registerTask('sleep', function(){
    console.log('I am sleeping');
});

grunt.registerTask('all',['run','sleep']);
}

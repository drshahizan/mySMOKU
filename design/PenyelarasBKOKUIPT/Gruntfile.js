module.exports = function(grunt) {
    grunt.initConfig({
		sass: {
			options: {
                includePaths: ['node_modules/bootstrap-sass/assets/stylesheets']
            },
            dist: {
				options: {
					outputStyle: 'compressed'
				},
                files: [{
                    'dist/assets/css/mooli.min.css': 'scss/main.scss', 	                        /* 'All main SCSS' */                
				}]
            }
        },
        uglify: {
          my_target: {
            files: {
                'dist/assets/bundles/libscripts.bundle.js':          ['dist/assets/vendor/jquery/jquery-3.5.1.min.js','dist/assets/vendor/bootstrap/js/bootstrap.bundle.js'], /* main js*/
                'dist/assets/bundles/vendorscripts.bundle.js':       ['dist/assets/vendor/metisMenu/metisMenu.js','dist/assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js','dist/assets/vendor/bootstrap-progressbar/js/bootstrap-progressbar.min.js','dist/assets/vendor/jquery-sparkline/js/jquery.sparkline.min.js'], /* coman js*/
                
                'dist/assets/bundles/mainscripts.bundle.js':         ['js/common.js'], /*coman js*/

                'dist/assets/bundles/apexcharts.bundle.js':          ['dist/assets/vendor/apexcharts/apexcharts.min.js'], /* Apex chart js*/
                'dist/assets/bundles/c3.bundle.js':                  ['dist/assets/vendor/c3/c3.min.js','dist/assets/vendor/c3/d3.v3.min.js'], /* c 3 chart js*/
                'dist/assets/bundles/morrisscripts.bundle.js':       ['dist/assets/vendor/raphael/raphael.min.js','dist/assets/vendor/morrisjs/morris.js'], /* Morris Plugin Js */
                'dist/assets/bundles/knob.bundle.js':                ['dist/assets/vendor/jquery-knob/jquery.knob.min.js'], /* knob js*/
                'dist/assets/bundles/chartist.bundle.js':            ['dist/assets/vendor/chartist/js/chartist.min.js','dist/assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.min.js','dist/assets/vendor/chartist-plugin-axistitle/chartist-plugin-axistitle.min.js','dist/assets/vendor/chartist-plugin-legend-latest/chartist-plugin-legend.js','dist/assets/vendor/chartist/Chart.bundle.js'], /*chartist js*/
                'dist/assets/bundles/easypiechart.bundle.js':        ['dist/assets/vendor/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js','dist/assets/vendor/jquery.easy-pie-chart/easy-pie-chart.init.js'],
                'dist/assets/bundles/flotscripts.bundle.js':         ['dist/assets/vendor/flot-charts/jquery.flot.js','dist/assets/vendor/flot-charts/jquery.flot.resize.js','dist/assets/vendor/flot-charts/jquery.flot.pie.js','dist/assets/vendor/flot-charts/jquery.flot.categories.js','dist/assets/vendor/flot-charts/jquery.flot.time.js'], /* Flot Chart js*/                
                
                'dist/assets/bundles/jvectormap.bundle.js':          ['dist/assets/vendor/jvectormap/jquery-jvectormap-2.0.3.min.js','dist/assets/vendor/jvectormap/jquery-jvectormap-world-mill-en.js','dist/assets/vendor/jvectormap/jquery-jvectormap-in-mill.js','dist/assets/vendor/jvectormap/jquery-jvectormap-us-aea-en.js'], /* jvectormap js*/
                'dist/assets/bundles/fullcalendarscripts.bundle.js': ['dist/assets/vendor/fullcalendar/moment.min.js','dist/assets/vendor/fullcalendar/fullcalendar.js'],   /* calender page js */ 
                'dist/assets/bundles/datatablescripts.bundle.js':    ['dist/assets/vendor/jquery-datatable/jquery.dataTables.min.js','dist/assets/vendor/jquery-datatable/dataTables.bootstrap4.min.js'], /* Jquery DataTable Plugin Js  */
                }
            }
        }                
    });
    grunt.loadNpmTasks("grunt-sass");
    grunt.loadNpmTasks('grunt-contrib-uglify');
    
    grunt.registerTask("buildcss", ["sass"]);	
    grunt.registerTask("buildjs", ["uglify"]);
};
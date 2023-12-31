/** // phpcs:ignoreFile
 * Project chart code
 *
 * @package WordPress
 * @since 1.0.0
 */

/* eslint-disable no-undef */
/* eslint-disable no-unused-vars */
/* eslint-disable array-callback-return */
/* eslint-disable no-var */

function ready( fn ) {
  if ( document.readyState !== "loading" ) {
    fn();
  } else {
    document.addEventListener( "DOMContentLoaded",fn );
  }
}

ready( function () {
  projectsAcceptedChart();
} );

function projectsAcceptedChart() {

  const ctx = document.getElementById('projectsAcceptedChart').getContext('2d');

  const data = {
    datasets: [
      {
        data: project_accepted_dates,
        backgroundColor: chart_background_colors
      }
    ]
  };

  Chart.defaults.font.size = 16;
  Chart.defaults.font.family = 'Clarity City';

  const config = {
    type: 'bar',
    data: data,
    options: {
			layout: {
				padding: {
					top: 20,
					bottom: 20
				}
			},
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: 'none'
        },
        tooltip: {
          mode: 'index'
        },
      },
      scales: {
        y: {
          title: {
            display: true,
            text: 'Projects Accepted in to CNCF'
          }
        },
        x: {
          grid: {
            display: false
          }
        }
      }
    }
  };
  const myChart = new Chart(ctx, config );
}

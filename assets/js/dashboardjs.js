// var dropdown = document.querySelectorAll('.dropdown');
// var dropdownArray = Array.prototype.slice.call(dropdown,0);
// dropdownArray.forEach(function(el){
// 	var button = el.querySelector('a[data-toggle="dropdown"]'),
// 			menu = el.querySelector('.dropdown-menu'),
// 			arrow = button.querySelector('i.icon-arrow');

// 	button.onclick = function(event) {
// 		if(!menu.hasClass('show')) {
// 			menu.classList.add('show');
// 			menu.classList.remove('hide');
// 			arrow.classList.add('open');
// 			arrow.classList.remove('close');
// 			event.preventDefault();
// 		}
// 		else {
// 			menu.classList.remove('show');
// 			menu.classList.add('hide');
// 			arrow.classList.remove('open');
// 			arrow.classList.add('close');
// 			event.preventDefault();
// 		}
// 	};
// })

// Element.prototype.hasClass = function(className) {
//     return this.className && new RegExp("(^|\\s)" + className + "(\\s|$)").test(this.className);
// };
// chart
// console.log(label);
  var data = {
  labels: label,
  datasets: [{
    label: "total events",
    backgroundColor: "rgba(255,99,132,0.2)",
    borderColor: "rgba(255,99,132,1)",
    borderWidth: 2,
    hoverBackgroundColor: "rgba(255,99,132,0.4)",
    hoverBorderColor: "rgba(255,99,132,1)",
    data: lineData,
  }]
};

var options = {
  animations: {
      radius: {
        duration: 400,
        easing: 'linear',
        loop: (context) => context.active
      }
    },
    hoverRadius: 12,
    hoverBackgroundColor: 'yellow',
    interaction: {
      mode: 'nearest',
      intersect: false,
      axis: 'x'
    },
  maintainAspectRatio: false,
  title: {
        display: true,
        text: 'Chart.js Line Chart'
      },
       responsive: true,
  scales: {
    y: {
      stacked: true,
      ticks: {
          // forces step size to be 50 units
          stepSize: 1
        },
      grid: {
        display: true,
        color: "rgba(255,99,132,0.2)"
      }
    },
    x: {
      grid: {
        display: false
      }
    }
  }
};

new Chart('myAreaChart', {
  type: 'line',
  options: options,
  data: data
});

// Sweet Alert

if(done) {
      // alert('Delete');
      Swal.fire({
              position: 'top',
              icon: 'success',
              title: 'Task marked as Done',
              showConfirmButton: false,
              timer: 1500
            })
    }else if (pending) { 
     Swal.fire({
              position: 'top',
              icon: 'info',
              title: 'Task marked as Pending',
              showConfirmButton: false,
              timer: 1500
            })
	}

// // Data tables

$(document).ready( function () {
    $('.table').DataTable({
    pageLength : 5,
    lengthMenu: [[5, 10, 15,20], [5, 10, 15, 20,]]
  } );
} );
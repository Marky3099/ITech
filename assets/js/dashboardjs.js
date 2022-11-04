
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
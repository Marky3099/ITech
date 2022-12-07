$('.del').click(function(e){
    e.preventDefault();
    const href = $(this).attr('href');
    Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            document.location.href = href;
            
          }
        })

 });
   if(msg){
      Swal.fire({
             icon: 'success',
             title: 'Deleted!',
             text: del,
             type: 'success',
            })
   }
   if(add){
      Swal.fire({
             icon: 'success',
             title: 'Added!',
             text: del,
             type: 'success',
            })
   }
   if(update){
      Swal.fire({
             icon: 'success',
             title: 'Updated!',
             text: del,
             type: 'success',
            })
   }
$(document).ready( function () {
    $('#table1').DataTable({
        pageLength : 5,
        lengthMenu: [[5, 10, 15,20], [5, 10, 15, 20,]]
      });
    $('#event-table').DataTable({
        pageLength : 5,
        lengthMenu: [[5, 10, 15,20], [5, 10, 15, 20,]]
      });
});
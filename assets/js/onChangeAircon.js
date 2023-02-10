$('#device_brand').on('change',function(){
  var brand = $(this).val();
  // alert(brand);
  $.ajax({
    method: 'GET',
    url: Url,
    data: {
      'brand': brand
    },
    success: function(response){
      
      var airconDetails = response.aircon;
      console.log(airconDetails);
      $('#aircon_id').empty();
      for (var i = 0; i < airconDetails.length; i++) {
        $('#aircon_id').append('<option value='+airconDetails[i].aircon_id+'>'+airconDetails[i].aircon_type+'</option>');
      }
    }
  })
})

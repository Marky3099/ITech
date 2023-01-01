var formatDate;
      var disable=[];
      for (var i = 0; i < disableDates.length; i++) {
        var splitDate = disableDates[i].date.split("-");
        var formatDate = parseInt(splitDate[2])+"-"+parseInt(splitDate[1]);
        disable.push(formatDate);
      }
    $('.datepicker').datepicker({
        format: 'mm/dd/yyyy',
        startDate: new Date(),
        beforeShowDay: function(date){
            dmy = date.getDate() + "-" + (date.getMonth() + 1);
            // console.log(dmy);
            if(disable.indexOf(dmy) != -1 || date.getDay() == 0 || date.getDay() == 6){
                return false;
            }
            else{
                return true;
            }
        }
    });
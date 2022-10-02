<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
        let btn = document.querySelector("#btn");
        let sidebar = document.querySelector(".sidebar");
        let cookieHandle = decodeURIComponent(document.cookie);
        let cookie1 = cookieHandle.split(';');
        for(let a = 0; a<cookie1.length; a++){
            let side = cookie1[a].split('=');
            console.log(side[0]); 
            if(side[0] === ' sidebar'){

                if (side[1] === 'sidebar' || side[1] === 'sidebar active') {
                    sidebar.className= side[1];
                }
            }
        }
        btn.onclick = function(){
            document.cookie ="sidebar=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            // alert(document.cookie);
            sidebar.classList.toggle("active");
            document.cookie = "sidebar="+sidebar.classList;
            // alert(document.cookie);
        }
    
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("profileDropdown");
// alert(cookie1);
var i;
for (i = 0; i < dropdown.length; i++) 
{
	dropdown[i].addEventListener("click", function(e) 
	{
        e.stopPropagation();
		this.classList.toggle("active");
        document.cookie = "profileDropDown="+this.classList;
		var dropdownContent = this.nextElementSibling;
		if (dropdownContent.style.display === "block") 
		{
			dropdownContent.style.display = "none";
 		}
 		else
 		{
  			dropdownContent.style.display = "block";
  		}
  	});
}
</script>
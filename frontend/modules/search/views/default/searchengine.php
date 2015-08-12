<?php

/* $.post("index.php?r=site/customer",{searchVal : searchTxt},function(output) {
	$("#output").html(output);

}
	); */

$script = <<< JS

window.searchq = function()
		{
		//alert('hi');
		var searchTxt = $("input[name='search']").val();
		var searchVal = 'searchV='+searchTxt;
		//alert(searchTxt);
		console.log(searchTxt);
		$.ajax({
    type: "POST",
    url: "index.php?r=default/customer",
    data : searchVal	 ,
    success: function(output) {
		//alert(output);
     $("#output").html(output);
    }
  });
		}
		
		
		//searchdivision
		 $('#searchdivision').submit(function(e)
{		
e.preventDefault();
e.stopImmediatePropagation();
		alert('hi');
		var searchTxt = $("input[name='search']").val();
		var searchVal = 'searchV='+searchTxt;
		
		console.log(searchTxt);
		var ddl = document.getElementById("categories");
	
 var type = ddl.options[ddl.selectedIndex].value;
		//alert(type);
if (type == "People")
{
alert('in people');
    		$.ajax({
    type: "POST",
    url: "index.php?r=search/default/user",
    data : searchVal	 ,
    success: function(output) {
		//alert(output);
     $("#output").html(output);
    }
  });
		}
		else if(type == "Market")
		{
		alert('this is market');
			$.ajax({
    type: "POST",
    url: "index.php?r=search/default/items",
    data : searchVal	 ,
    success: function(output) {
		alert(output);
     $("#output").html(output);
    }
  });
		}
		
	
}); 
		
		
		

		
		

		 

JS;
$this->registerJs($script);
?>

<form action="#" method="post" id="searchdivision">
 <select id="categories" name= "list">
  <option value="People">People</option>
  <option value="Market">Market</option>
  </select> 
<input type="text" name="search" placeholder="search for friends,market,designers,investors..."  style="width: 400px;" maxlength="27"/>
<input type="submit" class="btn btn-primary" value="search>>"/>
</form>

<div id="output">
</div>




<?php 

<?php 


include("backend/header.php"); 

$results['groups']=Group::getGroupsList($_SESSION['groupId']);
$results['shops']=Shop::getList();
?>

<form name="form" action="/main.php?action=dateRequest" method="POST">
		<table>
					
				
					<tr>
						<td>
						  Select Group
						</td>
                        <td>
						 <input type="text"  name="groupId" value="<?php echo $_SESSION['groupId']; ?>" />
		                  <input type="text" id="demo1" name="dateGroupId"  />
						  
		               </td>
		            </tr>
					<tr>
						<td>
						  Select a Place
						</td>
                        <td>
		                  <input type="text" id="demo2" name="shopId" />
						  
		               </td>
		            </tr>
					<tr>
						<td>
						  Select date
						</td>
                        <td>
		                  <input type="date"  name="date" />
						  
		               </td>
		            </tr>
					<tr>
						<td colspan="2">
							<input type="submit" name="groupForm" value="Send Date request" />
							</td>
					</tr>	
      
		</table>
        <script type="text/javascript">
        $(document).ready(function() {
            $("#demo1").tokenInput(<?php print_r(json_encode($results['groups']));?>
          , {
              propertyToSearch: "name",
			  
			   tokenLimit: 1,
			   tokenValue: "id",
			   theme: "facebook",
			    hintText: "search for group names",
                noResultsText: "no results found",
                searchingText: "searching :)",
              resultsFormatter: function(item){ return "<li>" + "<img src='" + item.icon_link + "' title='" + item.name + "' height='25px' width='25px' />" + "<div style='display: inline-block; padding-left: 10px;'><div class='full_name'>" + item.name + "</div><div class='email'>" + item.adminId + "</div></div></li>" },
              tokenFormatter: function(item) { return "<li><p>" + item.name +  "</p></li>" },
          });
		   $("#demo2").tokenInput(<?php print_r(json_encode($results['shops']));?>
          , {
              propertyToSearch: "name",
			  
			   tokenLimit: 1,
			   tokenValue: "id",
			   theme: "facebook",
			    hintText: "search for shop names",
                noResultsText: "no results found",
                searchingText: "searching :)",
              resultsFormatter: function(item){ return "<li>" + "<img src='" + item.icon_link + "' title='" + item.name + "' height='25px' width='25px' />" + "<div style='display: inline-block; padding-left: 10px;'><div class='full_name'>" + item.name + "</div><div class='email'>" + item.address + "</div></div></li>" },
              tokenFormatter: function(item) { return "<li><p>" + item.name +  "</p></li>" },
          });
        });
        </script>
		</form>   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
  
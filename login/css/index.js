$(document).ready(function(){

$("#login_error").hide(0);
$("#res").hide(0);
 $("#login-button").click(function(event){
		 event.preventDefault();

						var user=$("#Username").val().toString();
						var pass=$("#Password").val().toString();	
						var check=$('#CHECK').is(':checked');	
						var link=$("");

							if ((user=='')||(pass==''))

								{	 

									$("#login_error").show(0);
									$('.wrapper').addClass('form-erreur');



								}	
							else 

								{ 

										$.ajax

											({ 

					

												type: "GET", 
												
												url: "login_action.php?user="+user+"&pass="+pass+"&check="+check,

												data:"user="+user+"&pass="+pass+"&check="+check,


												success: function(data)

													{ 
														if(data=="OK")

															{
																$("#login_error").hide(0);
																$('form').fadeOut(500);
																$('.wrapper').addClass('form-success');						
																$(location).attr('href',"accueil.php");
																    // location.reload('accueil_admin.php');
																														
															}

														else if(data=="INVALID")

															{
																$("#login_error").show(0);
																$('.wrapper').addClass('form-erreur');

		
															}
														else
															{
																																															$(location).attr('href',"login.php");
																// $(location).attr('href',"../erreur/erreur.php");
															}

														} 

												});
										}
	 
});


   });

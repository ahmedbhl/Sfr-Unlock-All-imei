$(document).ready(function(){

// $("#login_error").hide(0);
// $("#res").hide(0);
 $("#send").click(function(event){
		 event.preventDefault();
							
						// var imei=$("textarea#imei").val();
						//.toString();
						// var imei = user;
						//split('\n').join('<br/>');
						// alert(imei);
						// var pass=$("#Password").val().toString();	
						
						var imei = $('#imei').val().split('\n');
						// code here using lines[i] which will give you each line
						
						// alert(imei[i]);
								// }
						var x=$("");
						

							if (imei=='')

								{	 

									// $("#login_error").show(0);
									// $('.wrapper').addClass('form-erreur');



								}	
							else 

								{ 
for(var i = 0;i < imei.length;i++){
x=imei[i].toString();

										$.ajax

											({ 

					


												
														
												type: "GET", 

												url: "check_imei_action.php?imei="+imei[i],

												data:"imei="+imei[i],
												
												success: function(data)

													{ 
													// alert('ok'+x);
														if(data=='clean')

															{
																// $.get("check_imei_action.php", function(data) {
																// x=x+data;
																$("#resultat_clean").html(imei[i]);
																	// });
															}
															else if(data=='07')

															{
																// $.get("check_imei_action.php", function(data) {
																// x=x+data;
																$("#resultat_07").html(imei[i]);
																	// });
															}
															else if(data=='03')

															{
																// $.get("check_imei_action.php", function(data) {
																// x=x+data;
																$("#resultat_03").html(imei[i]);
																	// });
															}
															if(data=='06')

															{
																// $.get("check_imei_action.php", function(data) {
																// x=x+data;
																$("#resultat_06").html(imei[i]);
																	// });
															}

														// else if(data=="INVALID")

															// {
																// $("#login_error").show(0);
																// $('.wrapper').addClass('form-erreur');

		
															// }
														else
															{
															
															data=x;
															str=str+data;
															$("#resultat_err").html(data);
															// $("#resultat_err").html(data);
															// document.getElementById("#resultat_err").innerHTML ='hello' ;
																// $("#resultat_err").html(data+i);
																// $("#resultat_err").innerHTML = data;
																// storedText = $('#resultat_err').text(); //to store it
																// $('#resultat_err').text(''); //to clear it
																// $('#resultat_err').text(storedText); //to load it back up again		
																								// $(location).attr('href',"login.php");
																// $(location).attr('href',"../erreur/erreur.php");
															}

														} 
														

												});
													// $("#resultat_err").html(imei[i]);

										}
										}
	 
});



















   });

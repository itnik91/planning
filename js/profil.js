$(function(){
	if($(".confirMail").text() == ""){
		$(".changeMail").hide();
	}
	$(".mail").click(function(){
		$(".changePass").hide();
		$(".changeMail").slideToggle();
	});

	if($(".confirPass").text() == ""){
		$(".changePass").hide();
	}
	$(".pass").click(function(){
		$(".changeMail").hide();
		$(".changePass").slideToggle();
	});

	$(".modifMail").click(function(){
		mail1 = $("input[name=email]").val();
		mail2 = $("input[name=email2]").val();
		if(mail1!=mail2){
			$(".confirMail").append("Les adresses mail ne correspondent pas");
			return false;
		}
	});

	$(".modifPass").click(function(){
		pass1 = $("input[name=pass1]").val();
		pass2 = $("input[name=pass2]").val();
		if(pass1!=pass2){
			$(".confirPass").append("Les mots de passe ne correspondent pas");
			return false;
		}
	});
});
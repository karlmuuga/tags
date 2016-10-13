$( document ).ready(function() {
		
		$("#changePhone").click(function(e){
			e.preventDefault();
			var phone = $("#phone").val();
				if(phone == ""){
					$("#retMessPhone").html("Palun sisestage korrektne telefoninumber!");$("#retMessPhone").css("color","red");
				}else{
				$.post("/ajax/phone.php",{phone: phone},
				function(data, status){
					if(data == "success"){
						$("#retMessPhone").html("Su telefoninumber on edukalt muudetud!");
						$("#retMessPhone").css("color","green");
						$("#mobile").html(phone);
						setTimeout(function(){$('#phoneModal').modal('hide');},1500);
						$("#phone").val("");
					}else{
						$("#retMessPhone").html("Vabandame, tekkis tõrge");$("#retMessPhone").css("color","red");
					}
				});
			}
		});
		$('#phoneModal').on('shown.bs.modal', function () {$('#phone').focus();});
		
		$("#changeeMail").click(function(e){
			e.preventDefault();
			var mail = $("#email").val();
			if(mail != ""){
				$.post("/ajax/mail.php",{mail: mail},
				function(data, status){
					if(data == "success"){
						$("#retMessEmail").html("Su uuele meilile on saadetud link!");
						$("#retMessEmail").css("color","green");
						setTimeout(function(){$('#emailModal').modal('hide');},1500);
						$("#email").val("");
						
					}else{
						$("#retMessEmail").html(data);
					}
				});
			}else{
				$("#retMessEmail").html("Palun sisestage andmed!");$("#retMessEmail").css("color","red");
			}
		});
		$('#emailModal').on('shown.bs.modal', function () {$('#email').focus();});
		
		$("#changeName").click(function(e){
			e.preventDefault();
			var name = $("#name").val();
			if(name != ""){
				$.post("/ajax/name.php",{name: name},
				function(data, status){
					if(status == "success"){
						if(data != "bad data"){
							$("#retMessName").html("Su nimi on edukalt muudetud!");
							$("#retMessName").css("color","green");
							$("#name2").html(name);
							setTimeout(function(){$('#nameModal').modal('hide');},1500);
							$("#name").val("");
						}else{
							$("#retMessName").html("Palun sisestage korrektne täisnimi!");$("#retMessName").css("color","red");
						}
					}else{
						$("#retMessName").html("Vabandame, tekkis tõrge");$("#retMessName").css("color","red");
					}
				});
			}else{
				$("#retMessName").html("Palun sisestage andmed!");$("#retMessName").css("color","red");
			}
		});
		$('#nameModal').on('shown.bs.modal', function () {$('#name').focus();});
		
		$("#changeState").click(function(e){
			e.preventDefault();
			var state = $("#state").val();
			if(state != ""){
				$.post("/ajax/state.php",{state: state},
				function(data, status){
					if(data == "success"){
						$("#retMessState").html("Su elukoht on edukalt muudetud!");
						$("#retMessState").css("color","green");
						$("#state2").html(state);
						setTimeout(function(){$('#stateModal').modal('hide');},1500);
						$("#state").val("");
					}else{
						$("#retMessState").html(data);
						$("#retMessState").css("color","red");
					}
				});
			}else{
				$("#retMessState").html("Palun sisestage andmed!");$("#retMessState").css("color","red");
			}
		});
		$('#stateModal').on('shown.bs.modal', function () {$('#state').focus();});
		
		$("#changePwd").click(function(e){
			e.preventDefault();
			var newPwd = $("#newPwd").val();
			var oldPwd = $("#oldPwd").val();
			var newPwdrep = $("#newPwdrep").val();
			if((newPwd != "" && newPwdrep != "") && (newPwd == newPwdrep)){
				$.post("/ajax/pwd.php",{oldPwd: oldPwd,newPwd: newPwd,newPwdrep: newPwdrep},
				function(data, status){
					if(data == "success"){
						$("#retMessPwd").html("Su parool on edukalt muudetud!");
						$("#retMessPwd").css("color","green");
						setTimeout(function(){$('#pwdModal').modal('hide');},1500);
						$("#newPwd").val("");
						$("#oldPwd").val("");
						$("#newPwdrep").val("");
					}else{
						$("#retMessPwd").html(data);
						$("#retMessPwd").css("color","red");
					}
				});
			}else{
				$("#retMessPwd").html("Palun jälgi, et paroolid kattuksid!");$("#retMessPwd").css("color","red");
			}
		});
		$('#pwdModal').on('shown.bs.modal', function () {$('#oldPwd').focus();});
		
	});
	
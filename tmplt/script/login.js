$(document).ready(function(){
	$('#btnLogin,#btnSure').click(function(){
alert($(this).attr('id'));
	data='lgnbtnid='+$(this).attr('id');
alert(data);
		$.ajax({
			type: "POST",
			url: 'model/login.php',
//			url: 'http://127.0.0.2/model/login.php',
			data: data,
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert('A:'+XMLHttpRequest.status);
                alert('B:'+XMLHttpRequest.readyState);
                alert('C:'+textStatus);
            },
			success: function(msg){
				//var data=eval('('+msg+')');
				alert('msg'+msg);
				switch(msg){
				case('0'):
					parent.document.location.href = "templt/agree.html"; 
					break;
				case('1'):
					parent.document.location.href = "templt/main.html"; 
					break;
				default:
					parent.document.location.href = "templt/login.html"; 
					break;
				}
				//if(msg=='zzz'){
				//	alert('1');
				//	parent.document.location.href = "templt/agree.html"; 
				//}else{
				//	alert('2');
				//	parent.document.location.href = "templt/login.html"; 
				//}
			}
		})
	})
})
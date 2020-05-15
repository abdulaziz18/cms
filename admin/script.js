var nav = document.getElementById('nav');
	nav.addEventListener("click",function(){
		var sidebar = document.querySelector('.sidebar');
		if(sidebar.style.display==="none"){
		sidebar.style.display="block";	
	}else{
		sidebar.style.display="none";
	}
		
		
	});

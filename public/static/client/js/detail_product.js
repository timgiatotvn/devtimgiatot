function getcolorIMG(e) {
	var cl_color = e.getAttribute("data-value");
	document.getElementById("input_color").value =  cl_color;
}

function getSize(e) {
	var cl_size = e.getAttribute("data-value");
	document.getElementById("input_size").value =  cl_size;
}

$(function() {
	
	$( 'ul.nav-color li' ).on( 'click', function() {
		$( this ).parent().find( 'li.active' ).removeClass( 'active' );
		$( this ).addClass('active');

	});


	$( 'ul.nav-size li' ).on( 'click', function() {
		$( this ).parent().find( 'li.active' ).removeClass( 'active' );
		$( this ).addClass('active');

	});
	
});

button_up=document.getElementById('up');
button_down=document.getElementById('down');

button_up.onclick=function() {setQuantity('up');}
button_down.onclick=function() {setQuantity('down');}

quantity = document.getElementById('quantity');

function setQuantity(upordown) {

	if (quantity.value > 1) {
		if (upordown == 'up'){
			++quantity.value;
		}
		else if (upordown == 'down'){
			--quantity.value;
		}
	}
	else if (quantity.value == 1) {
		if (upordown == 'up'){
			++quantity.value;
		}
	}
	else
	{
		quantity.value=1;
	}
}

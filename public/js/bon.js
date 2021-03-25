function afficher(id) {
	var elems;
	var checklist;
	var radios = document.getElementsByClassName('eq_radios');
	for(var i = 0; i < radios.length; i++) {
		if(radios[i].value != id) {
			elems = document.getElementsByClassName('eq' + radios[i].value);
			checklist = document.getElementsByClassName('eqcheck' + radios[i].value);
			for(var j = 0; j < elems.length; j++) {
				elems[j].style.display = 'none';
			}
			for(var k = 0; k < checklist.length; k++) {
				checklist[k].checked = false;
			}
		}
	}

	elems = document.getElementsByClassName('eq' + id);
	for(var i = 0; i < elems.length; i++) {
		elems[i].style.display = '';
	}
}

function changer(type) {
	if(type == 'eq') {
		document.getElementById('eq_card').style.display = '';
		eq_radios = document.getElementsByClassName('eq_radios');
		for(var i = 0; i < eq_radios.length; i++) {
			eq_radios[i].required = true;
		}
		document.getElementById('piece_card').style.display = 'none';
		piece_radios = document.getElementsByClassName('piece_radios');
		for(var i = 0; i < piece_radios.length; i++) {
			piece_radios[i].required = false;
			piece_radios[i].checked = false;
		}
	} else if(type == 'piece') {
		document.getElementById('piece_card').style.display = '';
		piece_radios = document.getElementsByClassName('piece_radios');
		for(var i = 0; i < piece_radios.length; i++) {
			piece_radios[i].required = true;
			
		}
		document.getElementById('eq_card').style.display = 'none';
		eq_radios = document.getElementsByClassName('eq_radios');
		for(var i = 0; i < eq_radios.length; i++) {
			eq_radios[i].required = false;
			eq_radios[i].checked = false;
		}
	}
}
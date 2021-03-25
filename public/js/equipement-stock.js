function afficher(id) {
	var elems = document.getElementsByClassName("list" + id);
	if(elems[0].style.display == '') {
		for(var i = 0; i < elems.length; i++) {
			elems[i].style.display = 'none';
		}
	} else {
		for(var i = 0; i < elems.length; i++) {
			elems[i].style.display = '';
		}
	}
}
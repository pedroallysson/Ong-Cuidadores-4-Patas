

/*
	Trechos de código responsável pela navegação da página através dos links da barra de navegação:
**/

const menuItems = document.querySelectorAll('.nav a[href^="#"]');
menuItems.forEach(item => {
	item.addEventListener('click', scrollToIdOnClick);
})

//Referencia o item e pega o offsetTop da página
function getScrollTopByHref(element){
	const id = element.getAttribute('href');
	return document.querySelector(id).offsetTop;
}

//Capura o click
function scrollToIdOnClick(event){
	event.preventDefault();
	const to = getScrollTopByHref(event.target) - 87;
	
	scrollToPosition(to);
}

//Mudança suave da animação (exceto no Browser Safari)
function scrollToPosition(to) {
	window.scroll({
		top: to,
		behavior: "smooth",
	});
}

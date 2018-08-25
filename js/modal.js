var Modal = function(arg) {
	var ModalObj = new Object();
	var data = {};
	ModalObj.data = data;
	function render() {
		let container = document.createElement('div');
		container.setAttribute('id','modal');

		let btnclose = document.createElement('span');
		btnclose.setAttribute('id','modal-close');
		btnclose.addEventListener('click',closeMe);
		btnclose.innerHTML = 'x';

		let header = document.createElement('div');
		header.setAttribute('class','modal-header');		
		header.innerHTML = '<h3>' + arg.title + '</h3>';

		let body = document.createElement('div');
		body.setAttribute('class','modal-body');		
		body.innerHTML = arg.body;

		header.appendChild(btnclose);
		container.appendChild(header);
		container.appendChild(body);

		document.body.appendChild(container);
		setTimeout(function() {
			container.setAttribute('class','loaded');
		},1000)		
	} render();
	function closeMe(){
		modal.classList.remove('loaded');
		setTimeout(function() {
			modal.parentNode.removeChild(modal);
		},500)	
		
	}
	return ModalObj;
}
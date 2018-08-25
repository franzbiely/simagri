var ProgressBar = {
	text : 'Loading...',
	render : function(tasks) {
		var ob1 = document.createElement('div');
			ob1.setAttribute('id','progress');
		var ob2 = document.createElement('div')
			ob2.setAttribute('class','bar');
		ob1.appendChild(ob2)
		ob2.innerHTML = this.text;
		document.body.appendChild(ob1)

		var c = 0; // bar value
		var k = 0; // interval
		console.log(tasks);
		var si = setInterval(function(){
			k++;
			c += (100 / Object.keys(tasks).length);
			ob2.style.width = c+'%';
			ob2.innerHTML = tasks[k].title;
			tasks[k].func();
			if(ob2.style.width == '100%'){
				setInterval(function() {
					ob2.innerHTML = "Complete";
				}, 1000)
				clearInterval(si);
			}
		},500);
	},
	closeMe : function(){
		obj1.parentNode.removeChild(obj1);
	}
}

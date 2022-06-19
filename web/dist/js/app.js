rsBox = document.getElementsByClassName('resulteBox')[0];


function searchLIKE(txt) 
{
	if (txt === '')
	{
		rsBox.classList += ' hide';
	}else{
		rsBox.classList.remove('hide');
	}
	words = txt.split(' ');

	if (words.length > 1) 
	{
		txt = words[words.length -1];
	}else{
		txt = words[0];
	}

	if (txt !== '') 
	{
		backPhase = words.splice(0,words.length -1).join(' ');
		console.log(backPhase);

		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			rsBox.innerHTML = this.responseText;
		}
		};
		xmlhttp.open("GET","dist/php/searchings.php?backWord="+backPhase+"&wordsLikeThis="+txt,true);
		xmlhttp.send();
	}
}


function GenerateText(Subtxt) {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		Subtxt.value = this.responseText;
	}
	};
	xmlhttp.open("GET","dist/php/searchings.php?GenerateText=1",true);
	xmlhttp.send();
}
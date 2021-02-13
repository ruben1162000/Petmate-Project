var radio = document.querySelectorAll('.radiostyle');
    	// var radlabel = document.querySelectorAll('#type label');
    	var radioIn = document.querySelectorAll('input[type=radio]');
    	// since pet shop is checked initially
    	radio[0].classList.add('fas','fa-paw','pawstyle');
    	
		radio[0].addEventListener('click',function(event){
			radio[0].classList.add('fas','fa-paw','pawstyle');
			radio[1].classList.remove('fas','fa-paw','pawstyle');
			radioIn[0].setAttribute('checked','checked');
		});

		radio[1].addEventListener('click',function(event){
			radio[1].classList.add('fas','fa-paw','pawstyle');
			radio[0].classList.remove('fas','fa-paw','pawstyle');
			radioIn[1].setAttribute('checked','checked');
		});
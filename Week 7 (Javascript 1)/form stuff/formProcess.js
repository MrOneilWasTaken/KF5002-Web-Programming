window.addEventListener('load', function() {
    'use strict';

    const l_form = document.getElementById('orderForm');
    l_form.CheckValue.onclick = calculateTotal;

    function calculateTotal(){
    	let l_total = 0;
    	const l_adverts = l_form.querySelectorAll('section.advert');
    	const l_advertsCount = l_adverts.length;
    	for (let i = 0; i < l_adverts.length; i++) {
    		const t_advert = l_adverts[i];
    		const t_checkbox = t_advert.querySelector('input[data-value][type=checkbox]');
    		alert(t_checkbox.dataset.value);
    	}
    }
});
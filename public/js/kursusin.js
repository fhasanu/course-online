$(".addToCart").click(function(){
	event.preventDefault();
        $.ajax({
            url: url + '/addtocart?=' + $('input[name=courseid]').val(),
            type: 'GET',
            success: function(r) {
            	console.log(r);
            }
        });  
});
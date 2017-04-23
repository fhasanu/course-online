$(".addToCart").click(function(){
	event.preventDefault();
        $.ajax({
            url: url + '/addtocart',
            type: 'GET',
            data: { 'course_id' : parseInt($('input[name=courseid]').val()) },
            success: function(data) {
            console.log(data);
			$('#cartadded').show();
            }
        });  
});

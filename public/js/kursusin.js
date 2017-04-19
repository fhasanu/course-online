$(".addToCart").click(function(){
	event.preventDefault();
        $.ajax({
            url: url + '/addtocart',
            type: 'GET',
            data: { 'course_id':$('input[name=courseid]').val() },
            success: function(data) {
            	console.log(data);
            }
        });  
});
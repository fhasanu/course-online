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

function doubleselect(main, sub){
    var $select1=$(main);
    var $select2=$(sub);
    $select1.data('options', $select2.html())
    $('button[type=reset]').on('mouseup', function() {
        setTimeout(function() {
            var val=$select1.val();
            var options = $($select1.data('options')).filter('[data-id="'+val+'"]');
            $select2.html(options);

        }, 100);
    });
    $select1.change(function(){
        var val=$select1.val();
        var options = $($select1.data('options')).filter('[data-id="'+val+'"]');
        $select2.html(options);
    });
}
doubleselect('#maincat', '#subcat');
doubleselect('#editmaincat', '#editsubcat');

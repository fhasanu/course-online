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

$("#addschedule").click(function(e){
    e.preventDefault();
    schedule = $(".scheduleinput");
    num = schedule.length + 1;
    str = "<div id='schedule"+num+"' class='scheduleinput'>\
                <div class='form-group row'>\
                    <div class='col-md-5'>\
                        <input class='form-control' name='day"+num+"' id='day"+num+"' type='text' placeholder='Hari'>\
                    </div>\
                    <div class='col-md-5'>\
                        <input class='form-control' name='time"+num+"' id='time"+num+"' type='time' placeholder='Waktu'>\
                    </div>\
                    <div class='col-md-2'>\
                        <input type='button' class='btndelete' id='btn"+num+"' value='x'>\
                    </div>\
                </div>\
            </div>\
";
    $("#jml").val(num);
    console.log($("#jml").val());
    schedule.parent().append(str);
});

$(".btndelete").on("click" ,function() {
    console.log("PRESSED");
    $(".btndelete").parent().parent().hide();
});
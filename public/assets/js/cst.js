

$('#select_all').on('click',function(){
    if(this.checked){
        $('.checkbox').each(function(){
            this.checked = true;
        });
    }else{
         $('.checkbox').each(function(){
            this.checked = false;
        });
    }
});

$('.checkbox').on('click',function(){
    if($('.checkbox:checked').length == $('.checkbox').length){
        $('#select_all').prop('checked',true);
    }else{
        $('#select_all').prop('checked',false);
    }
});


$("#addpost_selected").click(function() {


    // var datastring = $("#post_list").serialize();
    // var data = $('#myForm').serializeArray();
    $.ajax({
        type: "POST",
        url: "importdata/addpostsel",
        data: $("#post_list").serialize(),
        // dataType: "json",
        success: function(data) {
            alert(data);
        },
        error: function() {
            alert('error handling here');
        }
    });

    // alert(datastring);

});


$("#addallpos_t").click(function(event){
    // event.preventDefault();
    $('#loadingup_').show();
    $.ajax({
        url: "importdata/post",
        type:'POST',
        // dataType: "json",
        data:$("#wppostupload").serialize(),
        success:function(result){
            $('#loadingup').hide();
            $("#upsucc").html(result);
        }

    });
});


$("#wppostupload").submit(function (event) {
    $('#loadingup').show();
    $("#upsucc").html("");
    $.ajax({
        type:'POST',
        url: "importdata/post",
        
        data: new FormData(this),  
        // data:$("#wppostupload").serialize(),
        cache: false,
        contentType: false,
        processData: false,
        success:function(result){
            $('#loadingup').hide();
            $("#upsucc").html(result);
        }
    });
    return false;
});


$("#wppostsearch").submit(function (event) {
    $('#loadingsrh').show();
    $("#upsuccsearch").html("");
    $.ajax({
        type:'POST',
        url: "importdata/search",
        
        data: new FormData(this),  
        cache: false,
        contentType: false,
        processData: false,
        success:function(result){
            $('#loadingsrh').hide();
            $("#upsuccsearch").html(result);
        }
    });
    return false;
});

$("#addpub").submit(function (event) {
    
    $.ajax({
        type: "POST",
        url: $(this).attr("action"),
        data: new FormData(this),   
        cache: false,
        contentType: false,
        processData: false,
        success: function(res) {
            if(res=='ok'){
                $('.err_input').html('<div class="alert alert-success" style="color:#000;">Successfully Publication Added!<br><b><a href="/publications">Refresh now!</a></b></div>');
            } else {
                $('.err_input').html('<div class="alert alert-warning" style="color:#000;">'+res+'</div>'); 
            }
            
        },
        })
    return false;
    });


$("#xmlfile").submit(function (event) {
    $('#xml_loading').show();
    $('#xml_res').html("");
    // $('.progress').hide();



    $.ajax({
        type: "POST",
        url: "importdata/upload",
        data: new FormData(this),   
        cache: false,
        contentType: false,
        processData: false,
        success: function(res) {
            $('#xml_res').html("<p style='color:#000;margin-top:3px;'>"+res+"</p>");
            $('#xml_loading').hide();
            $('.progress').show();
        },beforeSend: function(){
                // $('#getdata').html("");
                // $('.progress').show();
                // const intervalID = setInterval(getData, 1000);
           },
        }).done(function (data) {
        console.log(data);
        // clearInterval(intervalID);
        });

    return false;
  });



  $("#post_list").submit(function (event) {
    $('#loadingdel').show();
    $('#upsuccdel').html("");
    $.ajax({
        type: "POST",
        url: "importdata/deletesel",
        data: new FormData(this),   
        cache: false,
        contentType: false,
        processData: false,
        success: function(res) {
            $('#upsuccdel').html("<p style='color:#000;margin-top:3px;'>"+res+"</p>");
            $('#loadingdel').hide();
        },
        }).done(function (data) {
        console.log(data);
        });

    return false;
  });


               

var poll = true;
var getData = function() {
    if (poll) {
        $('#getdata').html("");
        // $('.progress').show();
        $.get('importdata/count', function(data) { 
            data = JSON.parse(data);
            var max = data[0];
            var value = data[1];
            $('#getdata').html("Progress: "+value+" out of "+max); 
            $('.progress-bar').attr('aria-valuenow', value);
            $('.progress-bar').attr('aria-valuemax', max);
            $('.progress-bar').css('width', value + '%');
        });
    }
};
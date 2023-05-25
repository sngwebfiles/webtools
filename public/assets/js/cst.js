
function delete_confirm(){
    if($('.checkbox:checked').length > 0){
        var result = confirm("Are you sure to delete selected users?");
        if(result){
            return true;
        }else{
            return false;
        }
    }else{
        alert('Select at least 1 record to delete.');
        return false;
    }
}

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
        url: "http://localhost:8080/importdata/addpostsel",
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

// $("#submitxml").click(function(event){
//     event.preventDefault();
//     $('#xml_loading').show();

//     $.ajax({
//         type: "POST",
//         url: "importdata/upload",
//         data: $("#xmlfile").serialize(),
//         // dataType: "json",
//         success: function(data) {
//             alert(data);
//             $('#xml_loading').html(data);
//         }
//         ,
//         error: function() {
//             alert('error handling here');
//         }
//     });

// });

    //   enctype: 'multipart/form-data',
    //   method: 'POST',
    //   headers: {'X-Requested-With': 'XMLHttpRequest'},
    //   encode: true,


    

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
        },
        }).done(function (data) {
        console.log(data);
        });

    return false;
  });





// $('.delete_checkbox').click(function(){
//     if($(this).is(':checked'))
//     {
//      $(this).closest('tr').addClass('removeRow');
//     }
//     else
//     {
//      $(this).closest('tr').removeClass('removeRow');
//     }
//    });


// $('#delete_selected').click(function(){
  
//     var checkbox = $('.delete_checkbox:checked');
//     if(checkbox.length > 0)
//     {
//      var checkbox_value = [];
//      $(checkbox).each(function(){
//       checkbox_value.push($(this).val());
//      });
//      $.ajax({
//       url:"importdata/deletesel",
//       method:"POST",
//       data:{checkbox_value:checkbox_value},
//       success:function()
//       {
//        $('.removeRow').fadeOut(1500);
//         alert(checkbox_value);
//       }
//      })

   
//     }
//     else
//     {
//      alert('Select atleast one records');
//     }


//    });
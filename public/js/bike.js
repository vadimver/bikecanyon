// Like Publication Ajax
$(document).ready(function(){
    var csrftoken = $('meta[name="csrf-token"]').attr('content');
    $(".public_like").click(function(){
        var postid = $(this).val();

        $.ajax({
            url: '/pub_like',
            type: 'post',
            data: {'postid':postid,"_token": csrftoken},
            dataType: 'html',
            success: function(data){
              $('#id_'+postid).text(data);
            },
            error: function(xhr, textStatus) {
                //alert( [ xhr.status, textStatus ] );
            }

        });

    });
});

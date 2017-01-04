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
              $('#id_'+postid).text(' ' + data);
            },
            error: function(xhr, textStatus) {
                //alert( [ xhr.status, textStatus ] );
            }

        });

    });
});

// Like Comment Ajax
$(document).ready(function(){
    var csrftoken = $('meta[name="csrf-token"]').attr('content');
    $(".comment_like").click(function(){
        var commentid = $(this).val();


        $.ajax({
            url: '/comment_like',
            type: 'post',
            data: {'commentid':commentid,"_token": csrftoken},
            dataType: 'html',
            success: function(data){
              $('#idc_'+commentid).text(data);
            },
            error: function(xhr, textStatus) {

            }

        });

    });
});

// Add comment

$(document).ready(function(){

    $(".new_comment").submit(function(e) {

          post_elements = $(this).serialize();


          $.ajax({
           type: "POST",
           url: '/new_comment',
           data: post_elements,
           success: function(data) {
             var get = JSON.parse(data);

             var comments = $('#col_' + get.id_publication).text();
             var commentsPlus = +comments + 1;
             $('#col_' + get.id_publication).text(commentsPlus);
             $('#pub' + get.id_publication).append('<hr>'+
             '<div class="comment">'+
                '<i class="fa fa-user-circle" aria-hidden="true"></i>'+
                '<span id="nc_'+get.id_comment+'">'+get.name+'</span>'+
                '<button value="'+get.id_comment+'" class="btn btn-primary comment_like i_comment">'+
                  '<i id="idc_'+get.id_comment+'" class="fa fa-plus-circle" aria-hidden="true">'+get.like_comments+'</i>'+
                '</button>'+
                '<p class="comment_text">'+get.text+'</p>'+
             '</div>');

             $('.add_comment').val('');
           },
           error: function(xhr, textStatus) {
               alert( [ xhr.status, textStatus ] );
           }
         });

         e.preventDefault();

    });
});

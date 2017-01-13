// Settings tooltip
$(document).ready(function(){
    $('[data-toggle="date_registration"]').tooltip();
});

$(document).ready(function(){
    $('[data-toggle="quantity_publication"]').tooltip();
});

$(document).ready(function(){
    $('[data-toggle="quantity_profiles"]').tooltip();
});

$(document).ready(function(){
    $('[data-toggle="quantity_likes"]').tooltip();
});

$(document).ready(function(){
    $('[data-toggle="quantity_comments"]').tooltip();
});

$(document).ready(function(){
    $('[data-toggle="subscribes"]').tooltip();
});

$(document).ready(function(){
    $('[data-toggle="edit_profile"]').tooltip();
});

$(document).ready(function(){
    $('[data-toggle="delete_profile"]').tooltip();
});
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
                '<i class="fa fa-user-circle comment_user_style" aria-hidden="true"></i>'+
                '<span class="comment_user_style" id="nc_'+get.id_comment+'"> '+get.name+'</span>'+
                '<button value="'+get.id_comment+'" class="comment_like i_comment my_button">'+
                  '<i class="fa fa-heart" aria-hidden="true"></i><span id="idc_'+get.id_comment+'"class="public_like_number">'+get.like_comments+'</span>'+
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


/* */

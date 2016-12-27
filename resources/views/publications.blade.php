
@foreach ($publications as $publication)
    <?php $pub = 0; ?>
    @foreach ($comments as $comment)
        @if ($publication->id_publication == $comment->id_publication)
        <?php $pub++; ?>
        @endif

    @endforeach
<!-- # content_block -->
<div class="container content_block">
<div class="row">
  <div class="col-sm-12">
    <div class="list-group content_head">
      <a class="list-group-item active">
        <i class="fa fa-user-circle" aria-hidden="true"></i>
        <span>{{$publication->name_profile}} </span>
        <span class="content_date">{{$publication->created_at}}</span>

      </a>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">

    @if ($publication->img != NULL)
    <img src="../images/publications/{{$publication->id_profile}}/{{$publication->img}}" alt="..." class="img-rounded content_img">
    @endif
    @if ($publication->video != NULL)
    <iframe width="100%" height="400px" src="{{$publication->video}}" frameborder="0" allowfullscreen></iframe>
    @endif
    <p class="content_text">{{$publication->text}}</p>
  </div>
</div>
<!-- # content_footer -->
<div class="list-group content_footer">
  <div class="row">
      <div class="col-sm-4">
          <button value="{{$publication->id_publication}}" class="btn btn-primary public_like">
            <i id="id_{{$publication->id_publication}}" class="fa fa-plus-circle" aria-hidden="true">{{$publication->likes}}</i>
          </button>
      </div>
      <div class="col-sm-4">
            <i class="fa fa-comment-o i_all_comment" id="col_{{$publication->id_publication}}" data-toggle="collapse" data-target="#pub{{$publication->id_publication}}" aria-hidden="true">{{$pub}}</i>
      </div>
      <div class="col-sm-4">
            <span class="content-tag">{{$publication->name_tag}}</span>
      </div>

  </div>
    <div id="pub{{$publication->id_publication}}" class="collapse">
            @foreach ($comments as $comment)
                @if ($publication->id_publication == $comment->id_publication)
                    <!-- # comment -->
                    <hr>
                    <div class="comment">
                       <i class="fa fa-user-circle" aria-hidden="true"></i>
                       <span id="nc_{{$comment->id_comment}}">{{$comment->name}} </span>
                       <button value="{{$comment->id_comment}}" class="btn btn-primary comment_like i_comment">
                         <i id="idc_{{$comment->id_comment}}" class="fa fa-plus-circle" aria-hidden="true">{{$comment->like_comments}}</i>
                       </button>
                       <p class="comment_text">{{$comment->text}}</p>
                    </div>
                   <!-- / comment -->
                @endif
            @endforeach

    </div>
    <hr>
    <form class="new_comment" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id_publication" value="{{$publication->id_publication}}" >
        <input type="text" name="text"  class="form-control add_comment" placeholder="Добавить комментарий">
    </form>
    <div class="add_com" id="comment_{{$publication->id_publication}}">
    </div>
</div>
<!-- / content_footer -->
</div>
<!-- / content_block -->


@endforeach

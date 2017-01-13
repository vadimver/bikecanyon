<?php $quant_public = 0;?>
<div class="top_profiles">
    @foreach($top_profile as $tp)
        <div class="top_prof">
          <form action="{{ url('/list') }}" method="GET">
            <button type="submit" name="search" value="{{$tp->name_profile}}" class="top_button"> <span class="top_text">{{$tp->name_profile}}</span></button>
          </form>
          <button class="public_like my_button" data-toggle="quantity_likes" title="Лайки">
            <i class="fa fa-heart" aria-hidden="true"></i>
            <span class="public_like_number">
              <?php $col = 0;?>
              @foreach ($likes as $like)
                  @if ($tp->id_profile == $like->id_profile)
                    <?php $col = $col + $like['likes'];?>
                  @endif
              @endforeach
              {{$col}}
            </span>
          </button>
          <button class="profile_subscribes my_button button_text" data-toggle="subscribes" title="Подписчики">
                <i class="fa fa-check-square-o" aria-hidden="true"></i><span class="subscribe_number">{{$tp->subscribes}}</span>
          </button>
          <button class="my_button button_text quantity_publication" data-toggle="quantity_publication" title="Публикации">
            <i class="fa fa-id-card-o" aria-hidden="true"></i>
            @foreach ($publications as $publication)
              @if($publication->id_profile == $tp->id_profile)
                  <?php $quant_public++;?>
              @endif
            @endforeach
            {{$quant_public}}

          </button>
        </div>
    <?php $quant_public = 0; ?>
    @endforeach
</div>
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
    <div class="content_head">
        <i class="fa fa-user-circle" aria-hidden="true"></i>
        <span>{{$publication->name_profile}} </span>
        <span class="content_date">{{$publication->created_at->format('d/m/Y H:i')}}</span>
    </div>
    <hr>
  </div>
  <hr>
</div>
<div class="row">
  <div class="col-sm-12">

    @if ($publication->img != NULL)
    <img src="../images/publications/{{$publication->id_profile}}/{{$publication->img}}" alt="..." class="img-rounded content_img">
    @endif
    @if ($publication->video != NULL)
    <div class="videoWrapper">
      <iframe width="560" height="349" src="https://www.youtube.com/embed/{{$publication->video}}" frameborder="0" allowfullscreen></iframe>
    </div>
    @endif
    <p class="content_text">{{$publication->text}}</p>
    <hr>
  </div>
</div>
<!-- # content_footer -->
<div class="list-group content_footer">
  <div class="row">
      <div class="div_like col-sm-4">
          <button value="{{$publication->id_publication}}" class="public_like my_button">
            <i class="fa fa-heart" aria-hidden="true"></i><span id="id_{{$publication->id_publication}}" class="public_like_number">{{$publication->likes}}</span>
          </button>
      </div>
      <div class="div_comment col-sm-4">
           <button class="public_comment my_button" data-toggle="collapse" data-target="#collapse{{$publication->id_publication}}" aria-hidden="true">
            <i class="fa fa-comment i_all_comment" aria-hidden="true"></i>
            <span class="public_comment_number" id="col_{{$publication->id_publication}}">{{$pub}}</span>
           </button>
      </div>
      <div class="div_tags col-sm-4">
            <div class="btn-group">
                <button type="button" class="btn btn-primary btn-sm dropdown-toggle public_tags_button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Теги <span class="caret tags_caret"></span>
                </button>
                <ul class="dropdown-menu">
                   <?php
                      $tags = explode(",", $publication['tags']);
                      $count_tags = count($tags);
                      if(isset($tags)){
                        for($i = 0; $i < $count_tags; $i++){
                          echo "<button class='btn btn-default btn-sm public_tags_list'>" . $tags[$i] . "</button><br>";
                        }
                      }
                   ?>
                </ul>
            </div>
      </div>

  </div>
    <div id="collapse{{$publication->id_publication}}"class="collapse">
        <div id="pub{{$publication->id_publication}}">
            @foreach ($comments as $comment)
                @if ($publication->id_publication == $comment->id_publication)
                    <!-- # comment -->
                    <hr>
                    <div class="comment">
                       <i class="fa fa-user-circle comment_user_style" aria-hidden="true"></i>
                       <span class="comment_user_style" id="nc_{{$comment->id_comment}}">{{$comment->name}}</span>
                       <button value="{{$comment->id_comment}}" class="comment_like i_comment my_button">
                         <i class="fa fa-heart" aria-hidden="true"></i><span id="idc_{{$comment->id_comment}}" class="public_like_number">{{$comment->like_comments}}</span>
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
    </div>


</div>
<!-- / content_footer -->
</div>
<!-- / content_block -->

@endforeach
<div class="pagination_block">
    {{ $publications->links() }}
</div>

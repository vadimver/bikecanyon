
@foreach ($publications as $publication)

<!-- # content_block -->
<div class="container content_block">
<div class="row">
  <div class="col-sm-12">
    <div class="list-group content_head">
      <a href="#" class="list-group-item active">
        <i class="fa fa-user-circle" aria-hidden="true"></i>
        <span>{{$publication->name_profile}} </span>
        <span>{{$publication->created_at}}</span>
        <span class="content_tags">{{$publication->name_tag}}</span>
      </a>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <p class="content_text">{{$publication->text}}</p>
    <img src="../images/publications/{{$publication->id_profile}}/{{$publication->img}}" alt="..." class="img-rounded content_img">
  </div>
</div>
<!-- # content_footer -->
<div class="list-group content_footer">
  <div class="list-group-item active">
     <button id="public-like" value="123" class="btn btn-primary">
        <i class="fa fa-heart" aria-hidden="true"> {{$publication->likes}} </i>
     </button>
    <i class="fa fa-comment-o i_all_comment" data-toggle="collapse" data-target="#pub{{$publication->id_publication}}" aria-hidden="true">????</i>
  </div>
    <div id="pub{{$publication->id_publication}}" class="collapse">

       @foreach ($comments as $comment)
       @if ($publication->id_publication == $comment->id_publication)

           <!-- # comment -->
           <div class="comment">
              <i class="fa fa-user-circle" aria-hidden="true"></i>
              <span>{{$comment->name_profile}} </span>
              <i class="fa fa-heart i_comment" aria-hidden="true"> {{$comment->likes}} </i>
              <p class="comment_text">{{$comment->text}}</p>
           </div>
          <!-- / comment -->
       @endif

      @endforeach
      <form accept-charset="UTF-8" action="{{ url('/new_comment') }}" method="POST">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" value="{{$publication->id_publication}}" name="id_publication">
          <input type="text" class="form-control add_comment" name="text" placeholder="Добавить комментарий">
      </form>
    </div>
</div>
<!-- / content_footer -->
</div>
<!-- / content_block -->
@endforeach

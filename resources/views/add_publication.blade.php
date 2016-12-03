<!-- # accordion -->

<div class="container accordion">
  <div id="demo" class="collapse">
     <form accept-charset="UTF-8" action="{{ url('/new_publication') }}" method="POST">

         <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
             <label for="text" class="col-md-4 control-label">Text</label>
             <div class="col-md-6">
             <input id="text" type="text" class="form-control" name="text" value="{{ old('name') }}" required autofocus>

             @if ($errors->has('text'))
                 <span class="help-block">
                     <strong>{{ $errors->first('text') }}</strong>
                 </span>
             @endif
             </div>
         </div><br>

         <div>
             <label for="tags" class="col-md-4 control-label">Теги</label>
             <div class="col-md-8">
                 <select name="tags">
                    <option>Тег1</option>
                    <option>Тег2</option>
                    <option>Тег3</option>
                 </select>
             </div>
         </div><br>

         <div>
             <label for="img" class="col-md-4 control-label">Картинка</label>
             <div class="col-md-6">
             <input id="img" type="text" class="form-control" name='img'>
             </div>
         </div><br>


         <input type='hidden'>
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
         <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">

          <button type="submit" class="btn btn-primary">Добавить</button>

     </form>
  </div>
  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Добавить запись</button>
</div>

<!-- / accordion -->

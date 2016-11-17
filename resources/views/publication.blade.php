<!-- # accordion -->
<div class="container accordion">
  <div id="demo" class="collapse">
     <form>

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
         </div>

         <div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
             <label for="tags" class="col-md-4 control-label">Теги</label>
             <div class="col-md-6">
             <input id="tags" type="tags" class="form-control" name="text" value="{{ old('name') }}" required autofocus>

             @if ($errors->has('tags'))
                 <span class="help-block">
                     <strong>{{ $errors->first('tags') }}</strong>
                 </span>
             @endif
             </div>
         </div>
         <input type='hidden'>
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
         <input type="hidden" name="id_profile" value="{{ Auth::user()->id }}">

          <button type="submit" class="btn btn-primary">Добавить</button>

     </form>
  </div>
  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Добавить запись</button>
</div>
<!-- / accordion -->


<div>
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modal">Lisää kommentti</button>

    <div class="modal fade" id="modal" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                {!! Form::open(array('url' => request()->path().'/newComment', 'role' => 'form')) !!}
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Uusi kommentti</h4>
                </div>
                
                <div class="modal-body">
                    <div class="well">

                        <div class="form-group">
                            {!!Form::label('public', 'Näkyvyys:')!!}           
                            {!!Form::select('public', array('1'=>'Kaikki','0'=>'Ryhmänjohtajat'),['class'=>'form-control'])!!}
                        </div>

                        <div class="form-group">
                            {!!Form::label('comment', 'Kommentti:')!!}
                            {!!Form::textarea('comment', old('comment'), ['rows'=>'5', 'class'=>'form-control', 'placeholder'=>'Kirjoita kommentti!'])!!}
                        </div>
                        
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Peruuta</button>
                    <button type="submit" class="btn btn-default">Lisää</button>
                </div>
                {!! Form::close() !!}
            </div>

        </div>
    </div>
</div>
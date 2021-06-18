<div>Kontakt</div>
<hr>
<div class="row">
    <div class="col-sm-6 col-lg-3">
        <div class="price form-group">
            {{Form::label('contact_phone', 'Telefon',['class' => ''])}}
            {{Form::text('contact_phone',isset($item->contact_phone)?$item->contact_phone:null,['min'=>'0','class'=>'input-data input-info form-control','placeholder'=>''])}}
            <div class="error-msg"></div>
        </div>
    </div>
</div>
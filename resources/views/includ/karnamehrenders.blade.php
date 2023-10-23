@foreach($items as $item)

    <div class="col-md-2 m-t-b-20">

        <h5>{{$item->name}}</h5>
    </div>
    <div class="col-md-9 m-t-b-20" style="text-align: right">
        <input name="percent-{{$item->id}}" id="percent-{{$item->id}}" style="text-align: center"
               class="form-control col-md-3"
               value="0"
               required>
    </div>

@endforeach

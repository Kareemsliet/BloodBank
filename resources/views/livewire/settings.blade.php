<form wire:submit='change' >
    <div class="requests">
        <div class="head-text">
            <h2>فصائل الدم</h2>
        </div>
        <div class="content">
            <div class="container">
                <div class="row filter d-flex justify-content-around align-items-center gap-2">
                    @foreach ($blood_types as $value)
                    <div class="">
                        <input type="checkbox" wire:model='blood_typesIds' value="{{$value->id}}"  id="check-{{$value->id}}">
                        <label for="check-{{$value->id}}">{{$value->name}}</label>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="requests">
        <div class="head-text">
            <h2>المحافظات</h2>
        </div>
        <div class="content">
            <div class="container">
                <div  class="row filter  d-flex justify-content-around align-items-center gap-2">
                    @foreach ($states as $value)
                    <div class="">
                        <input type="checkbox" wire:model='statesIds' value="{{$value->id}}" id="check-{{$value->id}}">
                        <label for="check-{{$value->id}}">{{$value->name}}</label>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center align-items-center">
        <button type="submit" class="col-4">
            save
        </button>
    </div>
</form>

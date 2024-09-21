<div>
    <div class="requests">
        <div class="container">
            <div class="head-text">
                <h2>طلبات التبرع</h2>
            </div>
        </div>
        <div class="content">
            <div class="container">
                <form class="row filter">
                    <div class="col-md-5 blood">
                        <div class="form-group">
                            <div class="inside-select">
                                <select wire:model.live='blood_type_id' class="form-control">
                                    <option selected value="">اختر فصيلة الدم</option>
                                    @foreach ($blood_types as $value)
                                      <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 city">
                        <div class="form-group">
                            <div class="inside-select">
                                <select class="form-control" wire:model.live='state_id' >
                                    <option selected value="" >اختر اامحافظة</option>
                                    @foreach ($states as $value)
                                     <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="patients">
                    @forelse ($donations as $value)
                    <div class="details">
                        <div class="blood-type">
                            <h2 dir="ltr">{{$value->bloodTypes->name}}</h2>
                        </div>
                        <ul>
                            <li><span>اسم الحالة:</span>{{$value->name}}</li>
                      <li><span>مستشفى:</span>{{$value->hospital_adress}}</li>
                            <li><span>المدينة:</span>{{$value->city->name}}</li>
                        </ul>
                        <a href="{{route('donation',$value->id)}}">التفاصيل</a>
                    </div>
                    @empty
                    <div class="d-flex justify-content-center align-items-center">
                        <p class="fs-1">لاتوجد بيانات !</p>
                    </div>
                    @endforelse
                </div>
                @php
                    $queries=[];
                    $state=\App\Models\State::where('id','=',$state_id)->first();
                    $blood_type=\App\Models\BloodType::where('id','=',$blood_type_id)->first();
                    if($state){
                        $queries['state']=$state->name;
                    }
                    if($blood_type){
                        $queries['blood_type']=$blood_type->name;
                    }
                @endphp
                <div class="more mt-4">
                    <a href="{{url()->query(route('donations'), $queries)}}">المزيد</a>
                </div>
            </div>
        </div>
    </div>
</div>

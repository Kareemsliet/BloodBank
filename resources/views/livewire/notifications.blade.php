<div>
    <div class="requests" id="notifications">
        <div class="head-text">
            <h2>التنبيهات</h2>
        </div>
        <div class="content">
            <div class="container">
                <div class="patients">
                    @forelse ($notifications as $value)
                    <div class="details">
                        <div class="blood-type">
                            <h2 dir="ltr"><i class="fa fa-bell fa-2x"></i></h2>
                        </div>
                        <ul>
                            <li>{{$value->title}}</li>
                            <li>{{$value->description}}</li>
                        </ul>
                        <a href="" wire:click.prevent='delete({{$value->id}})'>حذف</a>
                        <a href="" wire:click.prevent='markAsRead({{$value->id}})'>قراءة</a>
                    </div>
                    @empty
                    <div class="d-flex justify-content-center align-items-center">
                        <p class="fs-1">لاتوجد  تنبيهات !</p>
                    </div>
                    @endforelse
                </div>
                <div class="pages">
                    {{$notifications->onEachSide(5)->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

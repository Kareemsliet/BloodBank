<?php

namespace App\Livewire;

use Livewire\Component;

class Notifications extends Component
{
    function delete($id){
         auth('clients')->user()->clientNotifications()->detach($id);
    }

    function markAsRead($id){
        auth('clients')->user()->clientNotifications()->updateExistingPivot($id,['read_at'=>now()]);
    }

    public function render()
    {
        $unReadNotificationsIds=auth('clients')->user()->clientNotifications()->where('read_at',null)->pluck('notifications.id')->toArray();
        if(count($unReadNotificationsIds)>0){
            auth('clients')->user()->clientNotifications()->updateExistingPivot($unReadNotificationsIds,['read_at'=>now()]);
        }
        $notifications= auth('clients')->user()->clientNotifications()->paginate(5);
        return view('livewire.notifications',['notifications'=>$notifications]);
    }
}

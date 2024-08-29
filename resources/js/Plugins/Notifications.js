import { toast } from 'vue3-toastify'
import { usePage, router } from '@inertiajs/vue3'

let page = usePage();

export const Notification = () => {
    router.on('finish',() => {
        let notification = page.props.flashMessage;
        
        if(notification?.type && notification?.body){
            toast(notification?.body,{
                type: notification?.type,
                autoClose: 2000
            });
        }
    })
}
<template>
    <li class="dropdown" >
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            <span class="glyphicon glyphicon-globe"></span> Notifications <span
                class="badge alert-danger">{{unreadNotifications.length}}</span>
        </a>

        <ul class="dropdown-menu" role="menu">
            <li>

            </li>
        </ul>
    </li>

</template>
<script>
    export default {
        props: ['unreads', 'userid'],
        data(){
            return {
                unreadNotifications: this.unreads
            }
        },
        mounted() {
            console.log('Component mounted.');
            Echo.private('App.User.' + this.userid)
                .notification((notification) => {
                    console.log(notification);
                    let newUnreadNotifications = 'dsadas';
                    this.unreadNotifications.push(newUnreadNotifications);

                });

        }
    }
</script>

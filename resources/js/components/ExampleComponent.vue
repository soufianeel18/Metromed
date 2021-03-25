<template>
    <FullCalendar :options="calendarOptions" />
</template>
<script>
    import FullCalendar from '@fullcalendar/vue'
    import dayGridPlugin from '@fullcalendar/daygrid'
    import interactionPlugin from '@fullcalendar/interaction'
    export default {
      props : ['tickets'],
      components: {
        FullCalendar
      },
      data() {
        return {
          calendarOptions: {
            plugins: [ dayGridPlugin, interactionPlugin],
            initialView: 'dayGridMonth', 
            events : JSON.parse(this.tickets),
            locale: 'fr',
          }
        }
      }
    }
</script>

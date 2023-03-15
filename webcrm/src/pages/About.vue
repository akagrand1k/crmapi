<template>
  <div class="fit">
    <q-calendar 
      style="height: 100%;"
      locale="ru"

      view="week"
      :weekdays="[1, 2, 3, 4, 5, 6, 0]"
      short-weekday-label

      hour24-format
      :interval-height="15"
      :interval-minutes="15"
      :interval-start="32"
      :interval-count="48"
    >
      <template #day-body="{ scope }">
        <template v-for="(event, index) in getEvents(scope)">
          <q-badge
            v-if="event.time"
            :key="index"
            class="my-event justify-center"
            :class="badgeClasses(event, 'body')"
            :style="badgeStyles(event, 'body', scope.timeStartPos, scope.timeDurationHeight)"
          >
            <q-icon v-if="event.icon" :name="event.icon" class="q-mr-xs"></q-icon><span class="ellipsis">{{ event.title }}</span>
          </q-badge>
        </template>
      </template>
    </q-calendar>
  </div>
</template> 

<script>
import { date } from 'quasar'
import { QCalendar } from '@quasar/quasar-ui-qcalendar'

export default {
  components: { QCalendar },
  setup() {

    console.log('[About] setup')
    function getCurrentDay() {
      
      return date.formatDate(new Date(), 'YYYY-MM-DD')
    }

    const events = [{
      title: 'Meeting',
      details: 'Time to pitch my idea to the company',
      date: getCurrentDay(),
      time: '10:00',
      duration: 120,
      bgcolor: 'red',
      icon: 'fas fa-handshake',
      side: 'left'
    },{
      title: 'Lunch',
      details: 'Company is paying!',
      date: getCurrentDay(),
      time: '11:30',
      duration: 90,
      bgcolor: 'teal',
      icon: 'fas fa-hamburger',
      side: 'right'
    },{
      title: 'Visit mom',
      details: 'Always a nice chat with mom',
      date: getCurrentDay(),
      time: '17:00',
      duration: 90,
      bgcolor: 'blue-grey',
      icon: 'fas fa-car'
    },
    ]

    function isCssColor (color) {
      return !!color && !!color.match(/^(#|(rgb|hsl)a?\()/)
    }

    function badgeClasses (event, type) {
      const cssColor = isCssColor(event.bgcolor)
      const isHeader = type === 'header'
      return {
        [`text-white bg-${event.bgcolor}`]: !cssColor,
        'full-width': !isHeader && (!event.side || event.side === 'full'),
        'left-side': !isHeader && event.side === 'left',
        'center-side': !isHeader && event.side === 'center',
        'right-side': !isHeader && event.side === 'right'
      }
    }

    function badgeStyles (event, type, timeStartPos, timeDurationHeight) {
      const s = {}
      if (isCssColor(event.bgcolor)) {
        s['background-color'] = event.bgcolor
        s.color = luminosity(event.bgcolor) > 0.5 ? 'black' : 'white'
      }
      if (timeStartPos) {
        s.top = timeStartPos(event.time) + 'px'
      }
      if (timeDurationHeight) {
        s.height = timeDurationHeight(event.duration) + 'px'
      }
      s['align-items'] = 'flex-start'
      return s
    }

    // click:time2: {"scope":{"timestamp":{"date":"2021-05-12","time":"06:46","year":2021,"month":5,"day":12,"hour":6,"minute":46,"weekday":3,"doy":132,"workweek":19,"hasDay":true,"hasTime":true,"past":true,"current":false,"future":false,"disabled":false}},"event":{"isTrusted":true}}
    return {
      getEvents(scope) {
        //console.trace()
        //console.log(scope)
        return events.filter(event => event.date == scope.timestamp.date)
      },
      isCssColor,
      badgeClasses,
      badgeStyles
    }
  }
}
</script>

<style src="@quasar/quasar-ui-qcalendar/dist/index.css"></style>

<style lang="sass">
.calendar-container
  position: relative

.my-event
  width: 100%
  position: absolute
  font-size: 12px

.full-width
  left: 0
  width: 100%

.left-side
  left: 0
  width: 49.75%

.center-side
  left: 33.33%
  width: 33.33%

.right-side
  left: 50.25%
  width: 49.75%
</style>

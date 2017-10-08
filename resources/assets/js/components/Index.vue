<template>
  <li :class="classes">
    <a :href="handle" data-toggle="tab">
      <h3 class="index__title">{{ index.name }}</h3>
      <div class="index__value">
        {{ index.current_value }}
        <span class="index__direction index__direction--up" v-if="index.increasing"></span>
        <span class="index__direction index__direction--down" v-if="index.decreasing"></span>
      </div>
    </a>
  </li>
</template>

<script>
  export default {
    props: ['index'],
    computed: {
      classes() {
        var classes = ['index'];
        if ( this.index.position == 1 ) {
          classes.push('active', 'index--active');
        }
        return classes.join(' ');
      },
      handle() {
        return '#' + this.index.name.toLowerCase().replace(/[^a-z-]+/, '-');
      }
    }
  }
</script>

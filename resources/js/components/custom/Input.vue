<template>
  <input v-model='v' @input="$emit('input', $event.target.value)" class="form-control"></input>
</template>

<script>
export default {
    model: {
        prop: 'val',
        event: 'input'
    },
    props: ['val'],
    data () {
        return {
            v:this.val
        }
    },
    mounted () {
        console.log(this.val)
    }
}
</script>

<style>

</style>
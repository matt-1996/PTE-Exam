<template>
    <div class="">
        <span v-for="(part, index) in sentenceParts" :key="index">
          <input
            v-if="part.input"
            v-model="part.guess"
            :aria-colindex="index"
            class="input"
          >
          <span v-else>{{ part.text }}</span>
        </span>
        <p v-if="allCorrect">All done!</p>
      </div>
</template>

<style scoped>
    input{
        border: 1px solid gray;
        border-radius: 2%;
        margin-top: 2px;
        margin-bottom: 2px;
        max-width: 10rem;
        background-color: aliceblue;
    }
</style>

<script>
export default{
    props: { sentence: String },

  data () {
    return {
      sentenceParts: []
    }
  },

  computed: {
    allCorrect () {
      return this.sentenceParts.every(this.partIsCorrect)
    }
  },

  methods: {
    partIsCorrect (part) {
      return !part.input || part.text === part.guess
    },

    reset () {
      const re = /(\[[^\]]*\])/

      // The filter removes empty strings
      const parts = this.sentence.split(re).filter(text => text)

      this.sentenceParts = parts.map(segment => {
        const isInput = re.test(segment)

        return {
          guess: '',
          input: isInput,
          text: isInput ? segment.slice(1, -1) : segment
        }
      })
    }
  },

  watch: {
    sentence: {
      immediate: true,
      handler: 'reset'
    }
  }
}

</script>


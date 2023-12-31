<template>
    <div class="">
        <span v-for="(part, index) in sentenceParts" :key="index">
            <span v-if="part.input">{{ part.answers[index] }}</span>
            <span >{{ part.text }}</span>
            <!-- <span v-for="(answer,index) in part.answers">
                {{ typeof(answer) }}
            </span>  -->
             <!-- <span v-if="part.input">{{ part.answers[index] }}</span> -->
          <!-- <input
            v-if="part.input"
            v-model="part.guess"
            :aria-colindex="index"
            class="input"
          > -->
          <!-- <span v-if="submited"></span> -->
          <!-- <span v-if="part.input">{{ part.answers }}</span> -->
          
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
      sentenceParts: [],
      submited: false
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
      const re = /\([^()]+\)/g;

      // The filter removes empty strings
      const parts = this.sentence.split(re).filter(text => text)
      const answers = this.sentence.match(re)
        // console.log(answers)
      this.sentenceParts = parts.map(segment => {
        const answersF = answers.map(answer => {
            const isInput1 = answer
            // console.log(2)
            const isInput = re.test(this.isInput1)
        })
        console.log(answersF)

        return {
          guess: '',
          answers:answers,
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


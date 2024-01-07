let data = "data"
let audioRecorder;
let audioChunks = [];
var voiceRecorder = {

    record(timeToRecord,progressWidth,snackbar,AudioUrl,showAudioPlayer,practiceDuration){
      const stopButton = document.getElementById('stop')
        console.log(document.getElementById("stop"))
        console.log(stopButton)
        let TimetoRecordinMiliSecond = timeToRecord * 1000
        const TimetoPlayinMiliSecond = TimetoRecordinMiliSecond + 1000

      navigator.mediaDevices.getUserMedia({ audio: true })
         .then(stream => {

            // Initialize the media recorder object
            audioRecorder = new MediaRecorder(stream);

            setInterval(function(){
                if(!(progressWidth.value >= timeToRecord))
                {
                    // if(progressWidth !>= )
                    progressWidth.value += 1
                }else{
                }
            },1000)

            // dataavailable event is fired when the recording is stopped
            audioRecorder.addEventListener('dataavailable', e => {
               audioChunks.push(e.data);
            });

            audioChunks = [];
               audioRecorder.start();
               console.log('Recording started! Speak now.');

            setTimeout(() => {
                audioRecorder.stop();
                var audio = new Audio('../../../../../sounds/beep.wav');
               //  audio.play();
               practiceDuration.value = 0
                snackbar.value = true
               console.log('Recording stopped! Click on the play button to play the recorded audio.')
            }, TimetoRecordinMiliSecond );

            setTimeout(() => {
                const blobObj = new Blob(audioChunks, { type: 'audio/webm' });
               const audioUr = URL.createObjectURL(blobObj);
               const audio = new Audio(audioUr);
               // audio.play();
               console.log('Playing the recorded audio!');
               console.log(audioUr)
               AudioUrl.value = audioUr
               showAudioPlayer.value = true
            }, TimetoPlayinMiliSecond);

            //stop recording when the stop button is clicked
            stopButton.addEventListener('click', () => {
               console.log(TimetoRecordinMiliSecond)
               TimetoRecordinMiliSecond = 1000
               audioRecorder.stop();
               var audio = new Audio('../../../../../sounds/beep.wav');
               audio.play();
              console.log('Recording stopped! Click on the play button to play the recorded audio.')

              setTimeout(() => {
               const blobObj = new Blob(audioChunks, { type: 'audio/webm' });
              const audioUr = URL.createObjectURL(blobObj);
              const audio = new Audio(audioUr);
           //    audio.play();
              console.log('Playing the recorded audio!');
              console.log(audioUr)
              AudioUrl.value = audioUr
              showAudioPlayer.value = true
           }, 1000);
            });

            // play the recorded audio when the play button is clicked
            playButton.addEventListener('click', () => {
               const blobObj = new Blob(audioChunks, { type: 'audio/webm' });
               audioUrl.value = URL.createObjectURL(blobObj);
               const audio = new Audio(audioUrl);
               audio.play();
               output.innerHTML = 'Playing the recorded audio!';
            });
         }).catch(err => {

            // If the user denies permission to record audio, then display an error.
            console.log('Error: ' + err);
         });
    },

    end(){
        console.log('end')
        // const TimetoRecordinMiliSecond = timeToRecord * 1000
        // const TimetoPlayinMiliSecond = TimetoRecordinMiliSecond + 1000
        let audioRecorder;
        let audioChunks = [];
      navigator.mediaDevices.getUserMedia({ audio: true })
         .then(stream => {

            // Initialize the media recorder object
            audioRecorder = new MediaRecorder(stream);

            // setInterval(function(){
            //     if(!(progressWidth.value >= timeToRecord))
            //     {
            //         // if(progressWidth !>= )
            //         progressWidth.value += 1
            //     }else{
            //     }
            // },1000)

            //dataavailable event is fired when the recording is stopped
            audioRecorder.addEventListener('dataavailable', e => {
               audioChunks.push(e.data);
            });

            //    audioChunks = [];
            //    audioRecorder.start();
            //    console.log('Recording started! Speak now.');

            // setTimeout(() => {
                audioRecorder.stop();
                var audio = new Audio('../../../../../sounds/beep.wav');
                audio.play();
                snackbar.value = true
               console.log('Recording stopped! Click on the play button to play the recorded audio.')
            // }, TimetoRecordinMiliSecond );

            setTimeout(() => {
                const blobObj = new Blob(audioChunks, { type: 'audio/webm' });
               const audioUr = URL.createObjectURL(blobObj);
               const audio = new Audio(audioUr);
            //    audio.play();
               console.log('Playing the recorded audio!');
               console.log(audioUr)
               AudioUrl.value = audioUr
               showAudioPlayer.value = true
            }, 1000);

            // stop recording when the stop button is clicked
            // stopButton.addEventListener('click', () => {
            //    audioRecorder.stop();
            //    output.innerHTML = 'Recording stopped! Click on the play button to play the recorded audio.';
            // });

            // play the recorded audio when the play button is clicked
            // playButton.addEventListener('click', () => {
            //    const blobObj = new Blob(audioChunks, { type: 'audio/webm' });
            //    audioUrl.value = URL.createObjectURL(blobObj);
            //    const audio = new Audio(audioUrl);
            //    audio.play();
            //    output.innerHTML = 'Playing the recorded audio!';
            // });
         }).catch(err => {

            // If the user denies permission to record audio, then display an error.
            console.log('Error: ' + err);
         });
    }
}

export default voiceRecorder;

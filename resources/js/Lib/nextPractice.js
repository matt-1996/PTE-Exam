const nextPractice = function NextPracticeId(currentPage, readAloudArray, practice)
{
    var result = Object.values(practice.value).forEach(function(key,index){
        readAloudArray.push(key.id)
    });
    // console.log(readAloudArray)
    const findArray = readAloudArray.find(x => x === currentPage.value );
    const valueArray = readAloudArray.filter(x => x == currentPage.value)
    const nextArrayIndex = readAloudArray.findIndex(x => x === currentPage.value) + 1
    return readAloudArray.at(nextArrayIndex)
    // console.log(readAloudArray.findIndex(x => x === nextArrayIndex))
    const index = readAloudArray.map(function(item){
        // console.log(item)
    })
    // console.log(index)
}

export default(nextPractice)
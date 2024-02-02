const previousPractice = function previousPracticeId(currentPage, practiceArray, practice)
{
    var result = Object.values(practice.value).forEach(function(key,index){
        practiceArray.push(key.id)
    });
    // console.log(practiceArray)
    const findArray = practiceArray.find(x => x === currentPage.value );
    const valueArray = practiceArray.filter(x => x == currentPage.value)
    const previousArrayIndex = practiceArray.findIndex(x => x === currentPage.value) - 1
    return practiceArray.at(previousArrayIndex)
    // console.log(practiceArray.findIndex(x => x === nextArrayIndex))
    const index = practiceArray.map(function(item){
        // console.log(item)
    })
    // console.log(index)
}

export default(previousPractice)
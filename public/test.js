/*function pushFront(arr,val){
    for(let i = (arr.lenth)+1; i>=0; i--){
        arr[i] = arr[i-1]
        console.log(arr)
    }
    arr[0] = val
    return arr
}

console.log("dfghj")
console.log(pushFront([5,7,2,3],8))*/

function pushFront(arr, val) {
    for (let i = arr.length - 1; i >= 0; i--) {

        console.log(i)
        arr[i + 1] = arr[i];

        console.log(arr)
        
    }
    arr[0] = val;
    return arr;
}

console.log(pushFront([5, 7, 2, 3], 8));
console.log(pushFront([99], 7));


//  pop


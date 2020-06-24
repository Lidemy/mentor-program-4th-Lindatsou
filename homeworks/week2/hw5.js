function join(arr, concatStr) {
    var result = arr[0]
    for (var i = 1; i < arr.length; i++) {
        result += concatStr + arr[i]
    }
  return result
}

function repeat(str, times) {
  var result = ''
  for (var i = 1; i <= times; i++) {
      result += str
  }
  return result
}

console.log(join([1, 2, 3], ''));
console.log(repeat('a', 5));

/*
console.log(join([1, 2, 3], ''))  ，正確回傳值：123
console.log(join(["a", "b", "c"], "!"))  ，正確回傳值：a!b!c
console.log(join(["a", 1, "b", 2, "c", 3], ','))  ，正確回傳值：a,1,b,2,c,3


console.log(repeat('a', 5))//，正確回傳值：aaaaa
console.log(repeat('yoyo', 0))//正確回傳值：yoyoyoyo
*/
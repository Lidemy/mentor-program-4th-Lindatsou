function capitalize(str) { 
    var result = ''
    var firstLetter = str[0]
    if (str[0] >= 'a' && str[0] <= 'z') {
        firstLetter = str[0].toUpperCase()
    }

    for (var i = 1; i < str.length; i++) {
        result += str[i]
    }
    return firstLetter + result
}

console.log(capitalize('nick'));

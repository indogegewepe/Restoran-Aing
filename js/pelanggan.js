let add = document.getElementById('penambahan');
let remove = document.getElementById('pengurangan');

let int = document.getElementById('1');
let integer = 0;

add.addEventListener('click',function(){
    integer += 1;
    int.innerHTML = integer;
})

remove.addEventListener('click',function(){
    integer -= 1;
    int.innerHTML = integer;
})
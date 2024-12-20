const first_name = document.getElementById('first_name')


form.addEventListener('submit' , (e) => {

let message = []
if (first_name.value === '' || first_name.value == null){
    message.push('Name is required')


}

if (message.legth > 0){
    e.preventDefault()
    errorElement.innerText = message.join(', ')}
})
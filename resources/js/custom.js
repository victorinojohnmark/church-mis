
const formInputs = document.querySelectorAll('input[type=text], textarea');

Array.from(formInputs).forEach((el) => {
    el.addEventListener('input', () => {
        capitalizeFirstLetter(el)
    })
})

function capitalizeFirstLetter(input) {
    // Get the input value
    let inputValue = input.value;

    // Capitalize the first letter of the input
    if (inputValue.length > 0) {
        inputValue = inputValue[0].toUpperCase() + inputValue.substring(1);
    }

    // Set the input value with the first letter capitalized
    input.value = inputValue;
}


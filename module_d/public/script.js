const buttonMaps = document.querySelectorAll('.grid-btn-map')
const cards = document.querySelectorAll('.card-region')
buttonMaps.forEach((btn, id) => {
    btn.addEventListener('click', () => {
        cards.forEach(item => {
            item.classList.remove('card-region-selected');
        })
        cards[id].classList.add('card-region-selected');
    })
})

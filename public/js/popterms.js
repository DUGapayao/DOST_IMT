const openTermsButton = document.querySelectorAll ('[data-pop-target]')
const closeTermsButton = document.querySelectorAll ('[data-close-button]')
const overlay = document.getElementById('overlay')

openTermsButton.forEach(button => {
    button.addEventListener('click', () => {
        const terms = document.querySelector(button.dataset.popTarget)
        openTerm(terms)
    })
})

overlay.addEventListener('click', () => {
    const terms = document.querySelectorAll('.terms.active')
    terms.forEach(terms => {
        closeTerm(terms)
    })
})

closeTermsButton.forEach(button => {
    button.addEventListener('click', () => {
        const terms = button.closest('.terms')
        closeTerm(terms)
    })
})

function openTerm(terms) {
    if (terms == null) return
    terms.classList.add('active')
    overlay.classList.add('active')
}

function closeTerm(terms) {
    if (terms == null) return
    terms.classList.remove('active')
    overlay.classList.remove('active')
}
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

openHelpButton.forEach(button => {
    button.addEventListener('click', () => {
        const modal = document.querySelector(button.dataset.popTarget);
        openModal(modal);
    });
});

overlay.addEventListener('click', () => {
    const modals = document.querySelectorAll('.terms.active');
    modals.forEach(modal => {
        closeModal(modal);
    });
});

closeHelpButton.forEach(button => {
    button.addEventListener('click', () => {
        const modal = button.closest('.terms');
        closeModal(modal);
    });
});

function openModal(modal) {
    if (modal == null) return;
    modal.classList.add('active');
    overlay.classList.add('active');
}

function closeModal(modal) {
    if (modal == null) return;
    modal.classList.remove('active');
    overlay.classList.remove('active');
}

// MOBILE MENU
const menuBtn      = document.getElementById('menuBtn');
const closeMenuBtn = document.getElementById('closeMenu');
const mobileMenu   = document.getElementById('mobileMenu');

menuBtn.addEventListener('click',      () => mobileMenu.classList.add('open'));
closeMenuBtn.addEventListener('click', () => mobileMenu.classList.remove('open'));

//  VER DEMO  fade overlay + scroll instantáneo 
document.getElementById('verDemo').addEventListener('click', () => {
    const overlay = document.getElementById('fadeOverlay');
    overlay.style.pointerEvents = 'auto';
    overlay.style.transition    = 'opacity 0.45s ease';
    overlay.style.opacity       = '1';

    setTimeout(() => {
        document.querySelector('.projects-section').scrollIntoView({ behavior: 'instant' });
        overlay.style.transition = 'opacity 0.55s ease';
        overlay.style.opacity    = '0';
        overlay.addEventListener('transitionend', () => {
            overlay.style.pointerEvents = 'none';
        }, { once: true });
    }, 450);
});

//  NAVBAR + SCROLL INDICATOR - un solo listener para ambos, con toggle de clases para eficiencia y claridad 
const navbar          = document.getElementById('navbar');
const scrollIndicator = document.getElementById('scrollIndicator');

window.addEventListener('scroll', () => {
    navbar.classList.toggle('scrolled', window.scrollY > 60);
    scrollIndicator.classList.toggle('hidden', window.scrollY > 80);
}, { passive: true });

// ─ANIMACIONES AL HACER SCROLL  IntersectionObserver 
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target);
        }
    });
}, { rootMargin: '0px 0px -10% 0px', threshold: 0.1 });

document.querySelectorAll(
    '.project-card, .line-inner, .ft-sub, .img-clip-outer, ' +
    '.img-caption-sub, .stat-item, .demo-title, .demo-card'
).forEach(el => observer.observe(el));

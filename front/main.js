// main.js - behavior for all pages

// Loader
window.addEventListener('load', () => {
  const loader = document.getElementById('loader');
  if (loader) {
    setTimeout(() => {
      loader.style.opacity = '0';
      setTimeout(()=> loader.style.display = 'none', 400);
    }, 900);
  }
  // start counters / animations after loader
  runCounters();
  runGsapIntro();
});

// PARTICLES.JS configuration (background)
// If particles.js not loaded, skip gracefully
if (window.particlesJS) {
  particlesJS('bg-particles', {
    particles: {
      number: { value: 60 },
      color: { value: '#00e1a7' },
      shape: { type: 'circle' },
      opacity: { value: 0.12 },
      size: { value: 3 },
      line_linked: { enable: true, color: '#00e1a7', opacity: 0.06 },
      move: { enable: true, speed: 1.2 }
    },
    interactivity: {
      detect_on: 'canvas',
      events: { onhover: { enable: true, mode: 'repulse' } }
    }
  });
}

// theme toggle (dark/light)
const themeBtn = document.getElementById('toggle-theme');
if(themeBtn){
  themeBtn.addEventListener('click', ()=>{
    document.body.classList.toggle('dark-mode');
    themeBtn.textContent = document.body.classList.contains('dark-mode') ? '☀️' : '🌙';
  });
}

// Simple counter animation
function runCounters(){
  const counters = document.querySelectorAll('.stat-number');
  counters.forEach(el=>{
    const end = el.dataset.end || el.textContent || '0';
    const numeric = parseInt(end.toString().replace(/\D/g,'')) || 0;
    let current = 0;
    const step = Math.max(1, Math.floor(numeric / 70));
    const interval = setInterval(()=>{
      current += step;
      if(current >= numeric){ el.textContent = end; clearInterval(interval); }
      else el.textContent = current;
    },20);
  });
}

// GSAP intro animations
function runGsapIntro(){
  if(window.gsap){
    gsap.from('.hero-text h1',{y:30,opacity:0,duration:0.9,delay:0.2});
    gsap.from('.hero-text p',{y:20,opacity:0,duration:0.9,delay:0.4});
    gsap.from('.feature-card',{y:20,opacity:0,duration:0.9,stagger:0.15,delay:0.6});
  }
}

// Smooth scroll for in-page anchors
document.querySelectorAll('a[href^="#"]').forEach(a=>{
  a.addEventListener('click', function(e){
    const href = this.getAttribute('href');
    if(href.length>1){
      e.preventDefault();
      const el = document.querySelector(href);
      if(el) el.scrollIntoView({behavior:'smooth',block:'start'});
    }
  });
});
